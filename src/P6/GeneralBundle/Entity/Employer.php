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
    /**
     * @var string
     *
     * @ORM\Column(name="Company", type="string", length=255)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="Contact", type="string", length=255)
     */
    private $contact;


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
}

