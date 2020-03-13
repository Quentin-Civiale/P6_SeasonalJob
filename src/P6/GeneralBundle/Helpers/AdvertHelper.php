<?php


namespace P6\GeneralBundle\Helpers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use P6\GeneralBundle\Entity\Advert;


class AdvertHelper
{
    protected $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getUser(Advert $advert) {
        $repository = $this->manager->getRepository('GeneralBundle:User');
        $user = $repository->find($advert->getUserId());

        return $user;
    }

    public function getEmployer(Advert $advert) {

        $repository = $this->manager->getRepository('GeneralBundle:Employer');
        $employer = $repository->find($advert->getChildId());

        return $employer;
    }

    public function getSeasonal(Advert $advert) {
        $repository = $this->manager->getRepository('GeneralBundle:Seasonal');
        $seasonal = $repository->find($advert->getChildId());

        return $seasonal;
    }
}