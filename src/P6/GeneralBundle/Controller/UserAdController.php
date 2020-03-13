<?php

namespace P6\GeneralBundle\Controller;

use P6\GeneralBundle\Entity\Advert;
use P6\GeneralBundle\Entity\User;
use P6\GeneralBundle\Helpers\AdvertHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserAdController extends Controller
{
    public function createdAdvertAction(Advert $advert)
    {
        $repository = $this->getDoctrine()->getRepository('GeneralBundle:Advert');
        $userAdvert = $repository->findBy(['id' => $advert->getId()]);

//        $employerRepository = $this->getDoctrine()->getRepository('GeneralBundle:Employer');
//        $seasonalRepository = $this->getDoctrine()->getRepository('GeneralBundle:Seasonal');
//        $employer = AdvertHelper::getEmployer($advert, $employerRepository);
//        $seasonal = AdvertHelper::getSeasonal($advert, $seasonalRepository);

        $advertHelper = $this->get('p6.general.helpers.advert_helper');

        $employer = $advertHelper->getEmployer($advert);
        $seasonal = $advertHelper->getSeasonal($advert);

        // on renvoie la vue
        return $this->render('@General/Default/createdAdvert.html.twig', [
            'advert' => $advert,
            'userAdvert' => $userAdvert,
            'employer' => $employer,
            'seasonal' => $seasonal
        ]);
    }

    public function userAdvertListAction($id, User $user)
    {
        $userInfo = $this->getDoctrine()->getRepository('GeneralBundle:User')->find($id);
        $advertsUser = $this->getDoctrine()->getRepository('GeneralBundle:Advert')->getAdvertByUser($user);

        $employer = $this->getDoctrine()->getRepository('GeneralBundle:Employer')->find($userInfo);
        $seasonal = $this->getDoctrine()->getRepository('GeneralBundle:Seasonal')->find($userInfo);

        return $this->render('@General/Default/userAdvert.html.twig', [
            'user' => $userInfo,
            'advertsUser' => $advertsUser,
            'employer' => $employer,
            'seasonal' => $seasonal
        ]);
    }
}