<?php

namespace P6\GeneralBundle\Controller;

use P6\GeneralBundle\Form\loginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        dump($request);

        // obtention de l'erreur de connexion s'il y en a un
        $error = $authenticationUtils->getLastAuthenticationError();

        // dernier nom d'utilisateur entré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        $formLogin = $this->createForm(loginFormType::class, [
            '_username' => $lastUsername,
//            'action' => $this->generateUrl('login'),
        ]);

        return $this->render('@General/Default/loginForm.html.twig', [
            'formLogin' => $formLogin->createView(),
//            '_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    public function logoutAction()
    {
        throw new \Exception('Ce message ne devrait pas s\'afficher!');
    }
}
