<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChatMessageRepository")
 */
class ChatMessage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $msgcontent;

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

    public function getMsgcontent(): ?string
    {
        return $this->msgcontent;
    }

    public function setMsgcontent(string $msgcontent): self
    {
        $this->msgcontent = $msgcontent;

        return $this;
    }
}
