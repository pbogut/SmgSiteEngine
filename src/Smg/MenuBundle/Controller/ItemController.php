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
        $entity = new Item();
        $form   = $this->createForm(new ItemType(), $entity);

        return $this->render('SmgMenuBundle:Item:new.html.twig', array(
            'entity' => $entity,
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
        $entity  = new Item();
        $request = $this->getRequest();
        $form    = $this->createForm(new ItemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity->setMenu($em->getReference('SmgMenuBundle:Menu', $menu_id));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('menu'));
            
        }

        return $this->render('SmgMenuBundle:Item:new.html.twig', array(
            'entity' => $entity,
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

        $entity = $em->getRepository('SmgMenuBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $editForm = $this->createForm(new ItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SmgMenuBundle:Item:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Item entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SmgMenuBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $editForm   = $this->createForm(new ItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('menu'));
        }

        return $this->render('SmgMenuBundle:Item:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Item entity.
     *
     */
    public function deleteAction($id)
    {
        $request = $this->getRequest();

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SmgMenuBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('menu'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
