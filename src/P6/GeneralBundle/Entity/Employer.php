<?php

namespace P6\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employer
 *
 * @ORM\Table(name="employer")
 * @ORM\Entity(repositoryClass="P6\GeneralBundle\Repository\EmployerRepository")
 */
class Employer extends User
{
//    const ROLE_EMPLOYER = 'employeur';
    const ROLE_DEFAULT2 = 'ROLE_EMPLOYER';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    protected $company;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255)
     */
    protected $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="profilPicture", type="string", length=255, nullable=true)
     */
    protected $profilPicture;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $role = self::ROLE_DEFAULT2;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return parent::getId();
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Employer
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Employer
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set profilPicture
     *
     * @param string $profilPicture
     *
     * @return Employer
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

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Employer
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    public function getFullName()
    {
        return $this->company;
    }
}
