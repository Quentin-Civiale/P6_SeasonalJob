<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavigationController extends Controller
{
    public function homeAction()
    {
        return $this->render('@General/Default/index.html.twig');
    }
}