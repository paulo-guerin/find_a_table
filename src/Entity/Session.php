<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
    private $status = 1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sessions")
     */
    private $host;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="sessions")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Town", inversedBy="sessions")
     */
    private $town;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $adress;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxplayer;

    public function __construct()
    {
        $this->sessioncoms = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSessioncoms()
    {
        return $this->sessioncoms;
    }

    /**
     * @param mixed $sessioncoms
     */
    public function setSessioncoms($sessioncoms): void
    {
        $this->sessioncoms = $sessioncoms;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionCom", mappedBy="session")
     */
    private $sessioncoms;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
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
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town): void
    {
        $this->town = $town;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

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
     * @return mixed
     */
    public function getMaxplayer()
    {
        return $this->maxplayer;
    }

    /**
     * @param mixed $maxplayer
     */
    public function setMaxplayer($maxplayer): void
    {
        $this->maxplayer = $maxplayer;
    }



}
