<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdDetailController extends Controller
{
    public function detailAction()
    {
        return $this->render('@General/Default/adDetail.html.twig');
    }
}