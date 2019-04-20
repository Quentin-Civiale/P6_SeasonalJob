<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostingAdController extends Controller
{
    public function postingAction()
    {
        return $this->render('@General/Default/postingAd.html.twig');
    }
}