<?php

namespace P6\GeneralBundle\Controller;

use Doctrine\ORM\EntityManager;
use P6\GeneralBundle\Entity\Contact;
use P6\GeneralBundle\Entity\Seasonal;
use P6\GeneralBundle\Entity\User;
use P6\GeneralBundle\Form\ContactType;
use P6\GeneralBundle\Helpers\AdvertHelper;
use P6\GeneralBundle\Helpers\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertDetailController extends Controller
{
    public function detailAction($id, Request $request, ContactNotification $notification)
    {
        $advert = $this->getDoctrine()->getRepository('GeneralBundle:Advert')->find($id);

        $advertHelper = $this->get('p6.general.helpers.advert_helper');

        $user = $advertHelper->getUser($advert);
        $employer = $advertHelper->getEmployer($advert);
        $seasonal = $advertHelper->getSeasonal($advert);

//        Gestion de l'envoi de mails via swiftmailer -> (ContactNotification $notification)

        if ($this->isGranted('ROLE_EMPLOYER') == true || $this->isGranted('ROLE_SEASONAL') == true) {

            $currentUserName = $this->getUser()->getFullName();
            $currentUserEmail = $this->getUser()->getEmail();

            $contact = new Contact();
            $contact->setUser($user);
            $contact->setCurrentUserName($currentUserName);
            $contact->setCurrentUserMail($currentUserEmail);
            $contact->setAdvert($advert);
            $contactForm = $this->createForm(ContactType::class, $contact);
            $contactForm->handleRequest($request);

            dump($currentUserName);
            dump($currentUserEmail);
            dump($contactForm);
            dump($contact);

            if ($contactForm->isSubmitted() && $contactForm->isValid()) {

                $notification->notify($contact);
                $this->addFlash('success', 'Votre message a bien été envoyé !');

                return $this->render('@General/Default/advertDetail.html.twig', [
                    'advert' => $advert,
                    'user' => $user,
                    'employer' => $employer,
                    'seasonal' => $seasonal,
                    'contactForm' => $contactForm->createView()
                ]);
            }

            return $this->render('@General/Default/advertDetail.html.twig', [
                'advert' => $advert,
                'user' => $user,
                'employer' => $employer,
                'seasonal' => $seasonal,
                'contactForm' => $contactForm->createView()
            ]);
        }

        else {
            return $this->render('@General/Default/advertDetail.html.twig', [
                'advert' => $advert,
                'user' => $user,
                'employer' => $employer,
                'seasonal' => $seasonal
            ]);
        }

    }

}