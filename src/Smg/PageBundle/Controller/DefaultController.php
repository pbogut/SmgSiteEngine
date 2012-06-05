<?php

namespace Smg\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('SmgPageBundle:Default:index.html.twig', array('name' => $name));
    }
}
