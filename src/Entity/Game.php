<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minplayer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $categoryID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxplayer;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(type="integer")
     */
    private $status = 1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="games")
     */
    private $category;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * @param mixed $sessions
     */
    public function setSessions($sessions): void
    {
        $this->sessions = $sessions;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="game")
     */
    private $sessions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMinplayer(): ?int
    {
        return $this->minplayer;
    }

    public function setMinplayer(?int $minplayer): self
    {
        $this->minplayer = $minplayer;

        return $this;
    }

    public function getMaxplayer(): ?int
    {
        return $this->maxplayer;
    }

    public function setMaxplayer(?int $maxplayer): self
    {
        $this->maxplayer = $maxplayer;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): self
    {
        $this->time = $time;

        return $this;
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

    public function getCategoryID(): ?int
    {
        return $this->categoryID;
    }

    public function setCategoryID(int $categoryID): self
    {
        $this->categoryID = $categoryID;

        return $this;
    }
}
