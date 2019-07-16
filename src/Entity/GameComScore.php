<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameComScoreRepository")
 */
class GameComScore
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDGame;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

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

    public function getIDGame(): ?int
    {
        return $this->IDGame;
    }

    public function setIDGame(int $IDGame): self
    {
        $this->IDGame = $IDGame;

        return $this;
    }
}
