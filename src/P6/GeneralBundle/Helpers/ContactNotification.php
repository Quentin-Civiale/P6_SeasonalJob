<?php

namespace P6\GeneralBundle\Helpers;

use Doctrine\ORM\Mapping as ORM;
use P6\GeneralBundle\Entity\Contact;
use Twig\Environment;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact_notification")
 */
class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact) {

        $message = \Swift_Message::newInstance()
            ->setSubject('My Season - Annonce N°' . $contact->getAdvert()->getId() . ' : ' . $contact->getAdvert()->getTitle())
            ->setFrom(['myseason.contact@gmail.com' => 'My Season - Mettre en relations saisonniers et employeurs'])
            ->setTo($contact->getUser()->getEmail())
            ->setReplyTo($contact->getCurrentUserMail())
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($this->renderer->render('@General/Default/contact.html.twig', [
                'contact' => $contact
            ]));

        $this->mailer->send($message);
    }

}
