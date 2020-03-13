<?php

namespace P6\GeneralBundle\Helpers;

use Twig\Extension\AbstractExtension as TwigExtension;
use Twig\TwigFunction;


class AdvertListTwigExtension extends TwigExtension
{
    private $container;
    public function __construct(AdvertHelper $container=null)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('advertUser', [$this, 'getUser']),
        ];
    }

    public function getUser($advert = null) {
        $user = $this->container->getUser($advert);
        return $user->getFullName();
    }

}