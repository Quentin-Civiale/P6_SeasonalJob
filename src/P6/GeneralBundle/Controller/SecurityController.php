<?php

namespace P6\GeneralBundle\Controller;

use P6\GeneralBundle\Annotation\Uploadable;
use P6\GeneralBundle\Annotation\UploadableField;
use P6\GeneralBundle\Entity\Seasonal;
use P6\GeneralBundle\Entity\User;
use P6\GeneralBundle\Form\loginFormType;
use P6\GeneralBundle\Form\SeasonalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use P6\GeneralBundle\Entity\Employer;
use P6\GeneralBundle\Form\EmployerType;

class SecurityController extends Controller
{
    //    MODAL AVEC DOUBLE-FORMULAIRE D'INSCRIPTION ET ENVOI DE DONNEES CREES PAR L'UTILISATEUR

    public function userRegistrationAction (Request $request)
    {
        // Formulaire création employeur

        $employer = new Employer();

//            dump($employer);

        if ($formEmployer = $this->createForm(EmployerType::class, $employer, array(
            'action' => $this->generateUrl('registerUser')
        ))) {

            $formEmployer->handleRequest($request);

//                dump($formEmployer);

            if ($formEmployer->isSubmitted() && $formEmployer->isValid()) {
                /** @var Employer $employer */
                $employer = $formEmployer->getData();
                $employer->setProfilPicture(User::getDefaultProfilPicture());

                dump($employer);

                $em = $this->getDoctrine()->getManager();
                $em->persist($employer);
                $em->flush();

                $this->addFlash('registration', 'Votre profil a bien été enregistré !');

                // Code permettant la connection lors de la validation de l'inscription
                return $this->get('security.authentication.guard_handler')
                    ->authenticateUserAndHandleSuccess(
                        $employer,
                        $request,
                        $this->get('p6.general.security.login_form_authenticator'),
                        'main'
                    );

//                    return $this->redirectToRoute('employer_account', [
//                        'role' => $employer->getRole(),
//                        'id' => $employer->getId(),
//                    ]);
            }
        }

        // Formulaire création saisonnier

        $seasonal = new Seasonal();

        if ($formSeasonal = $this->createForm(SeasonalType::class, $seasonal, array(
            'action' => $this->generateUrl('registerUser')
        ))) {

            $formSeasonal->handleRequest($request);

//                dump($formSeasonal);

            if ($formSeasonal->isSubmitted() && $formSeasonal->isValid()) {
                /** @var Seasonal $seasonal */
                $seasonal = $formSeasonal->getData();
//                    $defaultProfilePictureUrl = $this->get('kernel')->getProjectDir().'\web\Images\Pattern_My_Season.png';
                $seasonal->setProfilPicture(User::getDefaultProfilPicture());

                dump($seasonal);

//                    $seasonal->setUpdatedAt(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                $em->persist($seasonal);
                $em->flush();

                $this->addFlash('registration', 'Votre profil a bien été enregistré !');

                dump($seasonal->getId());

                // Code permettant la connection sur le compte lors de la validation de l'inscription
                return $this->get('security.authentication.guard_handler')
                    ->authenticateUserAndHandleSuccess(
                        $seasonal,
                        $request,
                        $this->get('p6.general.security.login_form_authenticator'),
                        'main'
                    );

//                    return $this->redirectToRoute('seasonal_account', [
//                        'role' => $seasonal->getRole(),
//                        'id' => $seasonal->getId(),
//                    ]);
            }
        }

        // Formulaire de connexion

//        $authenticationUtils = $this->get('security.authentication_utils');
//        dump($request);
//
//        // obtention de l'erreur de connexion s'il y en a un
//        $error = $authenticationUtils->getLastAuthenticationError();
//
//        // dernier nom d'utilisateur entré par l'utilisateur
//        $lastUser = $authenticationUtils->getLastUsername();
//
//        $formLogin = $this->createForm(loginFormType::class, [
//            '_email' => $lastUser,
//            'action' => $this->generateUrl('registerUser'),
//        ]);

//        return $this->render('base.html.twig', [
//            'formLogin' => $formLogin->createView(),
//            'error' => $error,
//        ]);

        // Formulaire de connexion doc symfony

        $authenticationUtils = $this->get('security.authentication_utils');

//        dump($employer);
//        dump($seasonal);
//        dump($authenticationUtils);

        $error = $authenticationUtils->getLastAuthenticationError();

//        dump($error);

        $lastUsername = $authenticationUtils->getLastUsername();

//        dump($lastUsername);

        $formLogin = $this->createForm(loginFormType::class, [
            '_email' => $lastUsername,
            'action' => $this->generateUrl('registerUser'),
        ]);

        dump($formLogin);

//        return $this->render('@General/Default/modalForm.html.twig', [
//            'last_username' => $lastUsername,
//            'error' => $error,
//        ]);

//        $this->addFlash('login', 'De retour sur My Season, il y a sûrement de nouvelles annonces faîtes pour vous !');

        // Renvoi de vue des différents formulaires

        return $this->render('@General/Default/modalForm.html.twig', [
            'formEmployer' => $formEmployer->createView(),
            'formSeasonal' => $formSeasonal->createView(),
            'formLogin' => $formLogin->createView(),
//            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }


//    public function loginAction(Request $request)
//    {
//        $authenticationUtils = $this->get('security.authentication_utils');
//        dump($request);
//
//        // obtention de l'erreur de connexion s'il y en a un
//        $error = $authenticationUtils->getLastAuthenticationError();
//
//        // dernier nom d'utilisateur entré par l'utilisateur
//        $lastUsername = $authenticationUtils->getLastUsername();
//
//        $formLogin = $this->createForm(loginFormType::class, [
//            '_username' => $lastUsername,
//            'action' => $this->generateUrl('login'),
//        ]);
//
//        return $this->render('@General/Default/modalForm.html.twig', [
//            'formLogin' => $formLogin->createView(),
////            '_username' => $lastUsername,
//            'error' => $error,
//        ]);
//    }
//
//    public function logoutAction()
//    {
//        throw new \Exception('Ce message ne devrait pas s\'afficher!');
//    }

}