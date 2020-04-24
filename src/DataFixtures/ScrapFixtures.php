<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ScrapFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $faker = Factory::create("fr_FR");
        

        // for($i = 0; $i < 100; $i++){
        //     $game = new Game;
        //     $game->setTitle($faker->words(3, true));
        //     $game->setCategoryID($faker->numberBetween(1, 20));
        //     $game->setDescription($faker->sentences(3, true));
        //     $game->setMinPlayer($faker->numberBetween(2, 3));
        //     $game->setMaxPlayer($faker->numberBetween(3, 15));
        //     $game->setImage($faker->imageUrl(640, 480));
        //     $game->setTime(strval( $faker->numberBetween(1, 8)) );
        //     $game->setStatus(1);
        //     $manager->persist($game);
        //     $manager->flush();
        // }
        // $product = new Product();
        

        
    }
}