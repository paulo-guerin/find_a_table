<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserListBySessionRepository")
 */
class UserListBySession
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
    private $IDUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDSession;

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

    public function getIDUser(): ?int
    {
        return $this->IDUser;
    }

    public function setIDUser(int $IDUser): self
    {
        $this->IDUser = $IDUser;

        return $this;
    }

    public function getIDSession(): ?int
    {
        return $this->IDSession;
    }

    public function setIDSession(int $IDSession): self
    {
        $this->IDSession = $IDSession;

        return $this;
    }
}
