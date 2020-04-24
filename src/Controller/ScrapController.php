<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ScrapController extends AbstractController{

    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


     /**
     * @Route("/admin/scrap_game", name="admin_scrap_game")
     */
    public function scrap_game(Request $request, EntityManagerInterface $entityManager){

        $codesource = file_get_contents('https://www.goupiya.com/fr/301-par-ordre-alphabetique?p=1');
        
        $alphabeticalLinks = $this->harvestAlphabeticalLinks($codesource);

        $gamesScrap = $this->collectGamesLinks($alphabeticalLinks);

        return $this->render("admin/scrap_game.html.twig", 
        [
            "linksTable" => $alphabeticalLinks,
            "gamesInfo" => $gamesScrap,
        ]);
    }


    public function harvestAlphabeticalLinks($codesource){
        preg_match_all("#<a href=\"https://www.goupiya.com/fr/3010[2-9].+\"#", $codesource, $resultsAlphabeticalLinksTable);
        $alphabeticalLinks = [];
        foreach ($resultsAlphabeticalLinksTable as $alphabeticalLinksTable) {
            foreach ($resultsAlphabeticalLinksTable as $alphabeticalLinksTable) {
                for ($i = 0 ; $i<=7 ; $i++ ) {
                    $n=1;
                    if ($i != 7){
                        $globalPageLink = substr($alphabeticalLinksTable[$i], 9, 38);
                        while ($this->url_exists($pageLink = $globalPageLink."?p=".$n)){
                            set_time_limit(200) ;
                            $alphabeticalLinks[] = $pageLink;
                            $n+=1;
                        }
                    }else{
                        $globalPageLink = substr($alphabeticalLinksTable[$i], 9, 42);
                        while ($this->url_exists($pageLink = $globalPageLink."?p=".$n)){
                            set_time_limit(200);
                            $alphabeticalLinks[] = $pageLink;
                            $n+=1;
                        }
                    }
                }
            }
        }
        return $alphabeticalLinks;
    }

    public function url_exists($url) {

        $headers = @get_headers($url); 
        // Use condition to check the existence of URL 
        if($headers && strpos( $headers[0], '200')) { 
            return true; 
        } 
        else { 
            return false;
        }        
    }

    public function collectGamesLinks($alphabeticalLinks){

        $gameLinks=[];
        foreach($alphabeticalLinks as $alphabeticalLink){

            $codesource = file_get_contents($alphabeticalLink);
            preg_match_all("#<a class=\"product_img_link\" href=\"https://www.goupiya.com/fr/jeux-de-societe/.+\"#", $codesource, $brutGamesLinkTable);
            foreach($brutGamesLinkTable as $GamesLinkTable){
                set_time_limit(200);
                foreach($GamesLinkTable as $brutGameLinks){
                    set_time_limit(200);
                    preg_match_all("#https://www.goupiya.com/fr/jeux-de-societe/.+.html#", $brutGameLinks, $pregGameLinksTable);
                    foreach($pregGameLinksTable as $GamesLinksTable){
                        set_time_limit(200);
                        foreach($GamesLinksTable as $gameLink){
                            if($this->url_exists($gameLink)){
                                $this->scrapGameInfos($gameLink);
                                $gameLinks[] = $gameLink;
                            }
                        }
                    }
                }
            }
        }
        return $alphabeticalLinks;
    }

    public function scrapGameInfos($gameLink){
        
        $newGame = new Game;
        $gameTitle = $this->scrap_function($gameLink, "/<h1.*?>(.*)<\/h1>/msi", 152, "<");
        $gameDescription = $this->scrap_description($gameLink, "/<div id=\"short_description_content\" class=\"rte align_justify\" itemprop=\"description\">(.*)<p id=\"see_desc\">/msi", 137, "<");
        $gameMinMaxPlayers = $this->scrap_function($gameLink, "#<span>.+joueur.*?<\/span>#", 6, "<");
        if($gameMinMaxPlayers != NULL){
            $gameMinPlayer=intval($gameMinMaxPlayers[0]);
            if(intval($gameMinMaxPlayers[5])){
                $gameMaxPlayer = $gameMinMaxPlayers[5];
            }else{
                $gameMaxPlayer = 10;
            }
        }else{
            $gameMinPlayer = 1;
            $gameMaxPlayer = 10;
        }
        $gameImage = $this->scrap_function($gameLink, "/<img id=\"bigpic\"(.*)<span class=\"span_link no-print\">/msi", 39, "\"");
        $gameTime = $this->scrap_time($gameLink, "/<tr class=\"odd\">(.*)<\\/tr>/isU", 38, "<");
        $newGame->setTitle($gameTitle);
        $newGame->setCategoryID(rand(62,80));
        $newGame->setDescription($gameDescription);
        $newGame->setMinPlayer($gameMinPlayer);
        $newGame->setMaxPlayer($gameMaxPlayer);
        $newGame->setImage($gameImage);
        $newGame->setTime($gameTime);
        $newGame->setStatus(1);
        $this->manager->persist($newGame);
        $this->manager->flush();



        return "Success";
        // return $this->render("admin/scrap_test.html.twig", 
        // [
        //     "gameTitle" => $gameTitle,
        //     "gameDescription" => $gameDescription,
        //     "gameMinMax" => $gameMinMax,
        //     "gameImage" => $gameImage,
        //     "gameTime" => $gameTime,
        //     "gameMaxPlayer" => $gameMaxPlayer,
        //     "gameMinPlayer" => $gameMinPlayer,
        // ]);
    }



    public function scrap_function($gameLink, $regexSearch, $startingPoint, $endpoint){
        $codesource = file_get_contents($gameLink);
        preg_match_all($regexSearch, $codesource, $pregContainer);
        if(isset($pregContainer[0][0])){
            $cleanContainer = preg_replace('/(\v|\s)+/', ' ', $pregContainer[0][0]);
            $lastElementLetter = 0;
            $lastElementLetterIsDefined = false;
            for($i = $startingPoint ; $i <= strlen($cleanContainer); $i++){
                if(!$lastElementLetterIsDefined){
                    if ($cleanContainer[$i] == $endpoint ){
                        $lastElementLetterIsDefined = true;
                        $lastElementLetter = $i;
                    }
                }
            }
            // return $cleanContainer;
            $result = substr($cleanContainer, $startingPoint, ($lastElementLetter-$startingPoint));
        } else {
            $result = NULL;
        }
        
        return $result = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $result);
    }

    public function scrap_description($gameLink, $regexSearch, $startingPoint, $endpoint){
        $codesource = file_get_contents($gameLink);
        preg_match_all($regexSearch, $codesource, $pregContainer);
        $cleanContainer = preg_replace('/(\v|\s)+/', ' ', $pregContainer[0][0]);
        strip_tags($cleanContainer);
        htmlspecialchars_decode($cleanContainer);
        $lastElementLetter = 0;
        if($cleanContainer[137] == "v" && $cleanContainer[138] == ">"){
            $startingPoint = 139;
        } elseif ($cleanContainer[137] == "v" && $cleanContainer[138] == " " && $cleanContainer[139] == "c"){
            $startingPoint = 167;
        } elseif ($cleanContainer[137] == $endpoint){
            $startingPoint = 143;
        } else {
            $startingPoint = 137;
        };

        $lastElementLetterIsDefined = false;
        for($i = $startingPoint ; $i <= strlen($cleanContainer); $i++){
            if(!$lastElementLetterIsDefined){
                if ($cleanContainer[$i] == $endpoint ){
                    $lastElementLetterIsDefined = true;
                    $lastElementLetter = $i;
                }
            }
        }

        
        $description = substr($cleanContainer, $startingPoint, ($lastElementLetter-$startingPoint));
        $description = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $description);

        return $description;
    }

    public function scrap_time($gameLink, $regexSearch, $startingPoint, $endpoint){
        $codesource = file_get_contents($gameLink);
        preg_match_all($regexSearch, $codesource, $pregContainerOdd);
        if (preg_match("/Editeur/", $pregContainerOdd[0][0])){
            $cleanContainer = preg_replace('/(\v|\s)+/', ' ', $pregContainerOdd[0][1]);
        } else {
            preg_match_all("/<tr class=\"even\">(.*)<\\/tr>/isU", $codesource, $pregContainerEven);
            $cleanContainer = preg_replace('/(\v|\s)+/', ' ', $pregContainerEven[0][0]);
        };
        strip_tags($cleanContainer);
        htmlspecialchars_decode($cleanContainer);
        $lastElementLetter = 0;
        $lastElementLetterIsDefined = false;
        for($i = $startingPoint ; $i <= strlen($cleanContainer); $i++){
            if(!$lastElementLetterIsDefined){
                if ($cleanContainer[$i] == $endpoint ){
                    $lastElementLetterIsDefined = true;
                    $lastElementLetter = $i;
                }
            }
        }
        
        $time = substr($cleanContainer, $startingPoint, ($lastElementLetter-$startingPoint));
        $time = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $time);

        return $time;
    }

    // /**
    //  * @Route("/admin/scrap_test", name="admin_scrap_test")
    //  */
    // public function scrap_test(){
    //     $codesource = file_get_contents("https://www.goupiya.com/fr/jeux-de-societe/5012-cerbere.html");
    //     preg_match_all("/<tr class=\"odd\">(.*)<\\/tr>/isU", $codesource, $pregContainerOdd);
    //     // #<span>.+joueurs.*?<\/span>#
    //     $startingPoint = 38;
        
    //     if (preg_match("/Editeur/", $pregContainerOdd[0][0])){
    //         $cleanContainer = preg_replace('/(\v|\s)+/', ' ', $pregContainerOdd[0][1]);
    //     } else {
    //         preg_match_all("/<tr class=\"even\">(.*)<\\/tr>/isU", $codesource, $pregContainerEven);
    //         $cleanContainer = preg_replace('/(\v|\s)+/', ' ', $pregContainerEven[0][0]);
    //     };
    //     strip_tags($cleanContainer);
    //     htmlspecialchars_decode($cleanContainer);
    //     $lastElementLetter = 0;
    //     $lastElementLetterIsDefined = false;
    //     for($i = $startingPoint ; $i <= strlen($cleanContainer); $i++){
    //         if(!$lastElementLetterIsDefined){
    //             if ($cleanContainer[$i] == "<" ){
    //                 $lastElementLetterIsDefined = true;
    //                 $lastElementLetter = $i;
    //             }
    //         }
    //     }

        
    //     $title = substr($cleanContainer, $startingPoint, ($lastElementLetter-$startingPoint));
    //     // return $cleanContainer;
    //     $title = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $title);

    //     return $this->render("admin/scrap_test.html.twig", 
    //     [
    //         "cleanContainer" => $cleanContainer,
    //         "description" => $title,
    //     ]);
    // }

}

