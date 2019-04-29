<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserAdController extends Controller
{
    public function userAdAction()
    {
        return $this->render('@General/Default/userAd.html.twig');
    }
}