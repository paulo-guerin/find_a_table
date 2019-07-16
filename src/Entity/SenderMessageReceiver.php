<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SenderMessageReceiverRepository")
 */
class SenderMessageReceiver
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
    private $IDSender;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDIntraMessage;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDReceiver;

    /**
     * @ORM\Column(type="integer")
     */
    private $readUnread;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDSender(): ?int
    {
        return $this->IDSender;
    }

    public function setIDSender(int $IDSender): self
    {
        $this->IDSender = $IDSender;

        return $this;
    }

    public function getIDIntraMessage(): ?int
    {
        return $this->IDIntraMessage;
    }

    public function setIDIntraMessage(int $IDIntraMessage): self
    {
        $this->IDIntraMessage = $IDIntraMessage;

        return $this;
    }

    public function getIDReceiver(): ?int
    {
        return $this->IDReceiver;
    }

    public function setIDReceiver(int $IDReceiver): self
    {
        $this->IDReceiver = $IDReceiver;

        return $this;
    }

    public function getReadUnread(): ?int
    {
        return $this->readUnread;
    }

    public function setReadUnread(int $readUnread): self
    {
        $this->readUnread = $readUnread;

        return $this;
    }
}
