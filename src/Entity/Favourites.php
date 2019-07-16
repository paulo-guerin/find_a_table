<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavouritesRepository")
 */
class Favourites
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDGames;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDGames(): ?int
    {
        return $this->IDGames;
    }

    public function setIDGames(int $IDGames): self
    {
        $this->IDGames = $IDGames;

        return $this;
    }

    public function getIDUser(): ?int
    {
        return $this->IDUser;
    }

    public function setIDUser(int $IDUser): self
    {
        $this->IDUser = $IDUser;

        return $this;
    }
}
