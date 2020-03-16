<?php

namespace P6\GeneralBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @var User|null
     */
    protected $user;

    /**
     * @var string|null
     */
    protected $currentUserName;

    /**
     * @var string|null
     */
    protected $currentUserMail;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min="10")
     */
    protected $message;

    /**
     * @var Advert|null
     */
    protected $advert;



//    Getters & setters ----------------------------------------------------------------------------------------------->

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return Contact
     */
    public function setUser(User $user): Contact
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrentUserName()
    {
        return $this->currentUserName;
    }

    /**
     * @param string|null $currentUserName
     * @return Contact
     */
    public function setCurrentUserName(string $currentUserName): Contact
    {
        $this->currentUserName = $currentUserName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrentUserMail()
    {
        return $this->currentUserMail;
    }

    /**
     * @param string|null $currentUserMail
     * @return Contact
     */
    public function setCurrentUserMail(string $currentUserMail): Contact
    {
        $this->currentUserMail = $currentUserMail;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Contact
     */
    public function setMessage(string $message): Contact
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Advert|null
     */
    public function getAdvert(): Advert
    {
        return $this->advert;
    }

    /**
     * @param Advert|null $advert
     * @return Contact
     */
    public function setAdvert(Advert $advert): Contact
    {
        $this->advert = $advert;
        return $this;
    }

}