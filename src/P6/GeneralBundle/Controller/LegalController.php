<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LegalController extends Controller
{
    public function legalNoticeAction()
    {
        return $this->render('@General/Default/legalNotice.html.twig');
    }

    public function privacyPolicyAction()
    {
        return $this->render('@General/Default/privacyPolicy.html.twig');
    }
}