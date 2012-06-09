<?php

namespace Smg\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smg\MenuBundle\Entity\Item;
use Smg\MenuBundle\Form\ItemType;

/**
 * Item controller.
 *
 */
class ItemController extends Controller
{
    /**
     * Displays a form to create a new Item entity.
     *
     */
    public function newAction($menu_id)
    {
        $item = new Item();
        $form   = $this->createForm(new ItemType(), $item);

        return $this->render('SmgMenuBundle:Item:new.html.twig', array(
            'form'   => $form->createView(),
            'menu_id'   => $menu_id
        ));
    }

    /**
     * Creates a new Item entity.
     *
     */
    public function createAction($menu_id)
    {
        $item  = new Item();
        $request = $this->getRequest();
        $form    = $this->createForm(new ItemType(), $item);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $item->setMenu($em->getReference('SmgMenuBundle:Menu', $menu_id));
            $em->persist($item);
            $em->flush();

            return $this->redirect($this->generateUrl('menu'));
            
        }

        return $this->render('SmgMenuBundle:Item:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Item entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $item = $em->getRepository('SmgMenuBundle:Item')->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $editForm = $this->createForm(new ItemType(), $item);

        return $this->render('SmgMenuBundle:Item:edit.html.twig', array(
            'item'      => $item,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Item entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $item = $em->getRepository('SmgMenuBundle:Item')->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $editForm   = $this->createForm(new ItemType(), $item);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($item);
            $em->flush();

            return $this->redirect($this->generateUrl('menu'));
        }

        return $this->render('SmgMenuBundle:Item:edit.html.twig', array(
            'item'      => $item,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Item entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $item = $em->getRepository('SmgMenuBundle:Item')->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $em->remove($item);
        $em->flush();

        return $this->redirect($this->generateUrl('menu'));
    }
}