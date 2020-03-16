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

        if ($formEmployer = $this->createForm(EmployerType::class, $employer, array(
            'action' => $this->generateUrl('registerUser')
        ))) {

            $formEmployer->handleRequest($request);

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

            }
        }

        // Formulaire création saisonnier

        $seasonal = new Seasonal();

        if ($formSeasonal = $this->createForm(SeasonalType::class, $seasonal, array(
            'action' => $this->generateUrl('registerUser')
        ))) {

            $formSeasonal->handleRequest($request);

            if ($formSeasonal->isSubmitted() && $formSeasonal->isValid()) {
                /** @var Seasonal $seasonal */
                $seasonal = $formSeasonal->getData();
//                    $defaultProfilePictureUrl = $this->get('kernel')->getProjectDir().'\web\Images\Pattern_My_Season.png';
                $seasonal->setProfilPicture(User::getDefaultProfilPicture());

                dump($seasonal);

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

            }
        }


        // Formulaire de connexion doc symfony

        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $formLogin = $this->createForm(loginFormType::class, [
            '_email' => $lastUsername,
            'action' => $this->generateUrl('registerUser'),
        ]);

        dump($formLogin);

        // Renvoi de vue des différents formulaires

        return $this->render('@General/Default/modalForm.html.twig', [
            'formEmployer' => $formEmployer->createView(),
            'formSeasonal' => $formSeasonal->createView(),
            'formLogin' => $formLogin->createView(),
//            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

}