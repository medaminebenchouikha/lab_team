<?php

namespace Med\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name,$age)
    {

        die($name.' '.$age);
        return $this->render('@MedFirst/Default/index.html.twig');
    }
}
