<?php

namespace P6\GeneralBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use P6\GeneralBundle\Entity\Advert;
use P6\GeneralBundle\Entity\AdvertSearch;
use P6\GeneralBundle\Entity\Employer;
use P6\GeneralBundle\Entity\Seasonal;
use P6\GeneralBundle\Entity\User;
use P6\GeneralBundle\Form\AdvertSearchType;
use P6\GeneralBundle\Form\AdvertType;
use P6\GeneralBundle\Helpers\AdvertHelper;
use P6\GeneralBundle\Repository\AdvertRepository;
use P6\GeneralBundle\Repository\SeasonalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertListController extends Controller
{
    public function advertListingAction(PaginatorInterface $paginator, Request $request)
    {
        $search = new AdvertSearch();
        $form = $this->createForm(AdvertSearchType::class, $search);
        $form->handleRequest($request);

        $adverts = $paginator->paginate(
            $this->getDoctrine()->getRepository('GeneralBundle:Advert')->findAllAdvert($search),
            $request->query->getInt('page', 1),
            6
        );

        $allAdverts = $this->getDoctrine()->getRepository('GeneralBundle:Advert')->findAllAdvert($search);

        $advertTotalNumber = $this->getDoctrine()->getRepository('GeneralBundle:Advert')->findAll();

        $advertFoundCount = count($adverts);
        $allAdvertCount = count($allAdverts);
        $advertTotalNumberCount = count($advertTotalNumber);

        if ($advertFoundCount <= 0) {
            $this->addFlash('noAdvertFound', 'Aucune annonce trouvée selon vos critères !');
        }
        elseif ($allAdvertCount < $advertTotalNumberCount) {
            $this->addFlash('advertFoundNumber', 'Il y a '.$allAdvertCount.' annonce(s) trouvée(s).');
        }
        else {
            $this->addFlash('advertTotalNumber', 'Trouvez la meilleure annonce parmis les '.$advertTotalNumberCount.' annonces publiées sur My Season !');
        }

        $em = $this->getDoctrine()->getManager();

        $advertHelper = $this->get('p6.general.helpers.advert_helper');

        dump($advertHelper);

        return $this->render('@General/Default/advertList.html.twig', [
            'adverts' => $adverts,
            'form' => $form->createView(),
//            'employer' => $employer,
//            'seasonal' => $seasonal
        ]);
    }

}