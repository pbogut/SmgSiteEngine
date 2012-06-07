<?php

namespace Smg\MenuBundle\Twig\Extension;

/**
 * Description of MenuExtension
 *
 * @author smeagol
 */
class MenuExtension extends \Twig_Extension
{
    //put your code here
    protected $container;
    
    function __construct($container) {
        $this->container = $container;
    }

        
    public function getFunctions()
    {
        return array(
            'smg_menu' => new \Twig_Function_Method($this, 'renderMenu')
        );
    }
    
    public function renderMenu($menu_name)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $menu = $em->getRepository('SmgMenuBundle:Menu')->findOneBy(array('name' => $menu_name));
        echo $this->container->get('twig')->render('SmgMenuBundle:Render:simple.html.twig', array('menu' => $menu));
    }


    public function getName()
    {
        return 'smg_menu';
    }
}