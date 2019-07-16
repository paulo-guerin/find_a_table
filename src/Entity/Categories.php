<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $catname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatname(): ?string
    {
        return $this->catname;
    }

    public function setCatname(string $catname): self
    {
        $this->catname = $catname;

        return $this;
    }
}
