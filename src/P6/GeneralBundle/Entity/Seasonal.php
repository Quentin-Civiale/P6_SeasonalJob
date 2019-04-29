<?php

namespace P6\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seasonal
 *
 * @ORM\Table(name="seasonal")
 * @ORM\Entity(repositoryClass="P6\GeneralBundle\Repository\SeasonalRepository")
 */
class Seasonal extends User
{
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="profilPicture", type="string", length=255)
     */
    private $profilPicture;


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Seasonal
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Seasonal
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set profilPicture
     *
     * @param string $profilPicture
     *
     * @return Seasonal
     */
    public function setProfilPicture($profilPicture)
    {
        $this->profilPicture = $profilPicture;

        return $this;
    }

    /**
     * Get profilPicture
     *
     * @return string
     */
    public function getProfilPicture()
    {
        return $this->profilPicture;
    }
}

