<?php

namespace P6\GeneralBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class AdvertSearch
{
//    public function __construct(string $userRoleSearch, string $categorySearch, string $placeSearch)
//    {
//        $this->userRoleSearch = $userRoleSearch;
//        $this->categorySearch = $categorySearch;
//        $this->placeSearch = $placeSearch;
//    }

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Veuillez choisir un type d'annonce !")
     */
    private $userRole;

    /**
     * @var string|null
     */
    private $category;

    /**
     * @var string|null
     */
    private $place;

    /**
     * @return string
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * @param string $userRole
     * @return AdvertSearch
     */
    public function setUserRole(string $userRole): AdvertSearch
    {
        $this->userRole = $userRole;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     * @return AdvertSearch
     */
    public function setCategory(string $category): AdvertSearch
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string|null $place
     * @return AdvertSearch
     */
    public function setPlace(string $place): AdvertSearch
    {
        $this->place = $place;
        return $this;
    }

}

