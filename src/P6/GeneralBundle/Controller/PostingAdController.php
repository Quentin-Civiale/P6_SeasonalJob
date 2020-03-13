<?php

namespace P6\GeneralBundle\Controller;

use P6\GeneralBundle\Entity\Advert;
use P6\GeneralBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostingAdController extends Controller
{
    public function postingAction()
    {
//        return $this->render('@General/Default/postingEmployerAd.html.twig');
        return $this->render('@General/Default/postingSeasonalAd.html.twig');
    }

    public function postingSeasonalAdAction(Request $request)
    {
        $advert = new Advert();
        $formAd = $this->createForm(AdvertType::class, $advert);

        $formAd->handleRequest($request);

        if ($formAd->isSubmitted() && $formAd->isValid()) {
            /** @var $advert Advert */
            $advert = $formAd->getData();

            // Date de création de l'annonce
            $advert->setPublishedDate(new \DateTime('now'));
            // Récupération du User ID de l'annonce
            $advert->setUserId($this->getUser()->getId());
            // Récupération du Seasonal ID de l'annonce
            $advert->setChildId($this->getUser()->getId());

            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('new_published_advert', [
                'id' => $advert->getId(),
            ]);
        }

        return $this->render('@General/Default/postingSeasonalAd.html.twig', [
            'formAd' => $formAd->createView(),
        ]);
    }

    public function postingEmployerAdAction(Request $request)
    {
        $advert = new Advert();
        $formAd = $this->createForm(AdvertType::class, $advert);

        $formAd->handleRequest($request);

        if ($formAd->isSubmitted() && $formAd->isValid()) {
            /** @var $advert Advert */
            $advert = $formAd->getData();

            // Date de création de l'annonce
            $advert->setPublishedDate(new \DateTime('now'));
            // Récupération du User ID de l'annonce
            $advert->setUserId($this->getUser()->getId());
            // Récupération du Employer ID de l'annonce
            $advert->setChildId($this->getUser()->getId());

            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('new_published_advert', [
                'id' => $advert->getId(),
            ]);
        }

        return $this->render('@General/Default/postingEmployerAd.html.twig', [
            'formAd' => $formAd->createView(),
        ]);
    }
}