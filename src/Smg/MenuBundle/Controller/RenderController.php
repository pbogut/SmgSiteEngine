<?php

namespace Smg\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RenderController extends Controller
{
    
    public function simpleAction($menu_name)
    {
        $em = $this->getDoctrine()->getEntityManager();
        /**
         * @var $menu Entity\Menu;
         */
        $menu = $em->getRepository('SmgMenuBundle:Menu')->findOneBy(array('name' => $menu_name));
        return $this->render('SmgMenuBundle:Render:simple.html.twig', array('menu_name' => $menu->getTitle(), 'menu' => $menu->getItems()));
    }
}
