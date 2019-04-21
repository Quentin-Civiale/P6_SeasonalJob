<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdListController extends Controller
{
    public function listAction()
    {
        return $this->render('@General/Default/adList.html.twig');
    }
}