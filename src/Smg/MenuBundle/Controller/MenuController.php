<?php

namespace Smg\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smg\MenuBundle\Entity\Menu;
use Smg\MenuBundle\Form\MenuType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Menu controller.
 *
 */
class MenuController extends Controller
{
    /**
     * Lists all Menu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $menus = $em->getRepository('SmgMenuBundle:Menu')->findAll();

        return $this->render('SmgMenuBundle:Menu:index.html.twig', array(
            'menus' => $menus
        ));
    }

    /**
     * Displays a form to create a new Menu entity.
     *
     */
    public function newAction()
    {
        $menu = new Menu();
        $form   = $this->createForm(new MenuType(), $menu);

        return $this->render('SmgMenuBundle:Menu:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Menu entity.
     *
     */
    public function createAction()
    {
        $menu  = new Menu();
        $request = $this->getRequest();
        $form    = $this->createForm(new MenuType(), $menu);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($menu);
            $em->flush();

            return $this->redirect($this->generateUrl('menu'));//, array('id' => $entity->getId())));
            //return new Response('
                
            
            
        }

        return $this->render('SmgMenuBundle:Menu:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Menu entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $menu = $em->getRepository('SmgMenuBundle:Menu')->find($id);

        if (!$menu) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $editForm = $this->createForm(new MenuType(), $menu);

        return $this->render('SmgMenuBundle:Menu:edit.html.twig', array(
            'menu'      => $menu,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Menu entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $menu = $em->getRepository('SmgMenuBundle:Menu')->find($id);

        if (!$menu) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $editForm   = $this->createForm(new MenuType(), $menu);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($menu);
            $em->flush();

            return $this->redirect($this->generateUrl('menu'));//, array('id' => $id)));
        }

        return $this->render('SmgMenuBundle:Menu:edit.html.twig', array(
            'menu'      => $menu,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Menu entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $menu = $em->getRepository('SmgMenuBundle:Menu')->find($id);

        if (!$menu) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $em->remove($menu);
        $em->flush();

        return $this->redirect($this->generateUrl('menu'));
    }
}
