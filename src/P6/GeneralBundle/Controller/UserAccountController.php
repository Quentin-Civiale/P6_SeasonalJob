<?php

namespace P6\GeneralBundle\Controller;

use P6\GeneralBundle\Entity\Employer;
use P6\GeneralBundle\Entity\Seasonal;
use P6\GeneralBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserAccountController extends Controller
{
    public function employerAccountAction(Employer $employer)
    {
        $employerRepository = $this->getDoctrine()->getRepository('GeneralBundle:Employer');
        $employer = $employerRepository->findOneBy(['id' => $employer->getId()]);

        return $this->render('@General/Default/employerAccount.html.twig', [
            'employer' => $employer,
        ]);
    }

    public function seasonalAccountAction(Seasonal $seasonal)
    {
        $seasonalRepository = $this->getDoctrine()->getRepository('GeneralBundle:Seasonal');
        $seasonal = $seasonalRepository->findOneBy(['id' => $seasonal->getId()]);

        return $this->render('@General/Default/seasonalAccount.html.twig', [
            'seasonal' => $seasonal,
        ]);
    }

//    public function employerAccountAction(User $user)
//    {
//        $employerRepository = $this->getDoctrine()->getRepository('GeneralBundle:User');
//        $user = $employerRepository->findOneBy(['id' => $user->getId()]);
//
////        $repository = $this->getDoctrine()->getRepository('GeneralBundle:Employer');
////        $employer = $repository->findOneBy(['id' => $employer->getId()]);
////        dump($employer);
//
//        return $this->render('@General/Default/employerAccount.html.twig', [
//            'employer' => $user,
//        ]);
//    }
//
//    public function seasonalAccountAction(User $user)
//    {
//        $seasonalRepository = $this->getDoctrine()->getRepository('GeneralBundle:User');
//        $user = $seasonalRepository->findOneBy(['id' => $user->getId()]);
//
//        return $this->render('@General/Default/seasonalAccount.html.twig', [
//            'seasonal' => $user,
//        ]);
//    }

//    public function userAccountAction(User $user)
//    {
//        if ($employerRepository = $this->getDoctrine()->getRepository('GeneralBundle:User')) {
//            $employer = $employerRepository->findOneBy(['id' => $user->getId()]);
//
//            return $this->render('@General/Default/employerAccount.html.twig', [
//                'employer' => $employer,
//            ]);
//        }
//
//        if ($seasonalRepository = $this->getDoctrine()->getRepository('GeneralBundle:User')) {
//            $seasonal = $seasonalRepository->findOneBy(['id' => $user->getId()]);
//
//            return $this->render('@General/Default/seasonalAccount.html.twig', [
//                'seasonal' => $seasonal,
//            ]);
//        }
//
//        return $this->render('@General/Default/index.html.twig');
//    }

//    public function accountAction()
//    {
//        return $this->render('@General/Default/userAccount.html.twig');
//    }

}