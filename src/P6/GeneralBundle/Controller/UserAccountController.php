<?php

namespace P6\GeneralBundle\Controller;

use P6\GeneralBundle\Entity\Advert;
use P6\GeneralBundle\Entity\Employer;
use P6\GeneralBundle\Entity\Seasonal;
use P6\GeneralBundle\Entity\User;
use P6\GeneralBundle\Form\editSeasonalAccountType;
use P6\GeneralBundle\Helpers\AdvertHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Security\Core\User\UserInterface;

class UserAccountController extends Controller
{
//    public function employerAccountAction(Employer $employer)
//    {
//        $employerRepository = $this->getDoctrine()->getRepository('GeneralBundle:Employer');
//        $employer = $employerRepository->findOneBy(['id' => $employer->getId()]);
//
//        return $this->render('@General/Default/employerAccount.html.twig', [
//            'employer' => $employer,
//        ]);
//    }
//
//    public function seasonalAccountAction(Seasonal $seasonal)
//    {
//        $seasonalRepository = $this->getDoctrine()->getRepository('GeneralBundle:Seasonal');
//        $seasonal = $seasonalRepository->findOneBy(['id' => $seasonal->getId()]);
//
//        return $this->render('@General/Default/seasonalAccount.html.twig', [
//            'seasonal' => $seasonal,
//        ]);
//    }

//    public function userAccountAction()
//    {
//        return $this->render('@General/Default/userAccount.html.twig');
//    }

    public function userProfilAction($id, User $user)
    {
        $userInfo = $this->getDoctrine()->getRepository('GeneralBundle:User')->find($id);
        $advertsNumber = $this->getDoctrine()->getRepository('GeneralBundle:Advert')->getAdvertNumberByUser($user);

        return $this->render('@General/Default/userAccount.html.twig', [
            'user' => $userInfo,
            'advertNumber' => $advertsNumber
        ]);
    }

    public function editSeasonalAccountAction(Seasonal $seasonal, Request $request, User $user)
    {
        $advertsNumber = $this->getDoctrine()->getRepository('GeneralBundle:Advert')->getAdvertNumberByUser($user);

        $editSeasonalForm = $this->createForm(editSeasonalAccountType::class, $seasonal);

        $oldProfilPicture = $seasonal->getProfilPicture();

        $editSeasonalForm->handleRequest($request);

        if ($editSeasonalForm->isSubmitted() && $editSeasonalForm->isValid()) {
            /** @var $seasonal Seasonal */
            $seasonal = $editSeasonalForm->getData();

            // Gestion de la mise en place de la nouvelle image de profil du saisonnier

            // récupération de l'image via son url si une nouvelle image est proposée
            $file = $editSeasonalForm->get('profilPicture')->getData();
            if (!empty($file)) {
                $filename =  pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $filename.'.'.$file->guessExtension();
                $newFilename = str_replace(' ', '', $newFilename);

//                try {
                $file->move(
                    $this->getParameter('profil_picture_directory'),
                    $newFilename
                );
//                } catch (FileException $e) {
//                    dump($e);
//                }

                $finalPath = 'uploads/profilPicture/'.$newFilename;
                $seasonal->setProfilPicture($finalPath);
            }

            else {
                // condition lorsque l'image de profil n'est pas modifiée
                if (!empty($oldProfilPicture)) {
                    $seasonal->setProfilPicture($oldProfilPicture);
                }
            }

//            $seasonal->setUpdatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($seasonal);
            $em->flush();

            $this->addFlash('editSeasonalAccount', 'Votre image de profil a été modifié avec succès !');

            return $this->render('@General/Default/userAccount.html.twig', [
                'advertNumber' => $advertsNumber
            ]);
        }

        return $this->render('@General/Default/editUserAccount.html.twig', [
            'seasonal' => $seasonal,
            'file' => $oldProfilPicture,
            'editSeasonalForm' => $editSeasonalForm->createView(),
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