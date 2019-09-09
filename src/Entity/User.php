<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->sessioncoms = new ArrayCollection();
    }

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
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $profilepicture = "avatar.png";

    /**
     * @return mixed
     */
    public function getProfilepicture()
    {
        return $this->profilepicture;
    }

    /**
     * @param mixed $profilepicture
     */
    public function setProfilepicture($profilepicture): void
    {
        $this->profilepicture = $profilepicture;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionCom", mappedBy="user")
     */
    private $sessioncoms;

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

}