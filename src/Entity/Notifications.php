<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationsRepository")
 */
class Notifications
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
     * @ORM\Column(type="datetime")
     */
    private $notificationTime;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $redirectionUrl;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDUser;

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

    public function getNotificationTime(): ?\DateTimeInterface
    {
        return $this->notificationTime;
    }

    public function setNotificationTime(\DateTimeInterface $notificationTime): self
    {
        $this->notificationTime = $notificationTime;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getRedirectionUrl(): ?string
    {
        return $this->redirectionUrl;
    }

    public function setRedirectionUrl(string $redirectionUrl): self
    {
        $this->redirectionUrl = $redirectionUrl;

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
