<?php

namespace P6\GeneralBundle\Controller;

use P6\GeneralBundle\Entity\AdvertSearch;
use P6\GeneralBundle\Form\AdvertSearchType;
use P6\GeneralBundle\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavigationController extends Controller
{
    public function homeAction()
    {
        $advert = $this->getDoctrine()->getRepository('GeneralBundle:Advert')->findLatestAdvert();

        return $this->render('@General/Default/index.html.twig', [
            'adverts' => $advert
        ]);
    }
}