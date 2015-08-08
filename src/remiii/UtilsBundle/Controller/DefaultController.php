<?php

namespace remiii\UtilsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('remiiiUtilsBundle:Default:index.html.twig', array('name' => $name));
    }
}
