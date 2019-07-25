<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharterController extends Controller
{
    public function employerCharterAction()
    {
        return $this->render('@General/Default/employerCharter.html.twig');
    }

    public function seasonalCharterAction()
    {
        return $this->render('@General/Default/seasonalCharter.html.twig');
    }
}