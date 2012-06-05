<?php

namespace Smg\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('SmgNewsBundle:Default:index.html.twig', array('name' => $name));
    }
}
