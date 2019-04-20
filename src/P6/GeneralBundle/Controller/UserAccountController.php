<?php

namespace P6\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserAccountController extends Controller
{
    public function accountAction()
    {
        return $this->render('@General/Default/userAccount.html.twig');
    }
}