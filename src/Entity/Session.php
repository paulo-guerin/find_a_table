<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
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
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $hostID;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sessions")
     */
    private $host;

    /**
     * @return mixed
     */
    public function getHostID()
    {
        return $this->hostID;
    }

    /**
     * @param mixed $hostID
     */
    public function setHostID($hostID): void
    {
        $this->hostID = $hostID;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $gameID;

    /**
     * @return mixed
     */
    public function getGameID()
    {
        return $this->gameID;
    }

    /**
     * @param mixed $gameID
     */
    public function setGameID($gameID): void
    {
        $this->gameID = $gameID;
    }

    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     */
    public function setGame($game): void
    {
        $this->game = $game;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="sessions")
     */
    private $game;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param mixed $adress
     */
    public function setAdress($adress): void
    {
        $this->adress = $adress;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $adress;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxplayer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMaxplayer(): ?int
    {
        return $this->maxplayer;
    }

    public function setMaxplayer(int $maxplayer): self
    {
        $this->maxplayer = $maxplayer;

        return $this;
    }
}
