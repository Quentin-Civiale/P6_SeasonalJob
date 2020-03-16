<?php

namespace P6\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="P6\GeneralBundle\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "employer" = "Employer", "seasonal" = "Seasonal"})
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Veuillez indiquez un email valide !")
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;

    /**
     * The encoded password
     *
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="registration", type="string", length=255)
     */
    protected $registration;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set registration
     *
     * @param string $registration
     *
     * @return User
     */
    public function setRegistration($registration)
    {
        $this->registration = $registration;

        return $this;
    }

    /**
     * Get registration
     *
     * @return string
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    public static function getDefaultProfilPicture()
    {
        return 'Images/Pattern_My_Season.png';
    }

//    ---------- Méthode pour la gestion de la connexion ----------

    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        return array($this->role);
    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        $this->password = null;
    }

    public function getFullName() {
        return "";
    }

}

