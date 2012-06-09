<?php

namespace Smg\NewsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smg\NewsBundle\Entity\News;
use Smg\NewsBundle\Form\NewsType;

/**
 * News controller.
 *
 */
class NewsController extends Controller
{
    /**
     * Lists all News entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $newses = $em->getRepository('SmgNewsBundle:News')->findAllOrderedByDate();

        return $this->render('SmgNewsBundle:Backend/News:index.html.twig', array(
            'newses' => $newses
        ));
    }

    /**
     * Displays a form to create a new News entity.
     *
     */
    public function newAction()
    {
        $news = new News();
        $form   = $this->createForm(new NewsType(), $news);

        return $this->render('SmgNewsBundle:Backend/News:new.html.twig', array(
            'news' => $news,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new News entity.
     *
     */
    public function createAction()
    {
        $news  = new News();
        $request = $this->getRequest();
        $form    = $this->createForm(new NewsType(), $news);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($news);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_news_show', array('id' => $news->getId())));
            
        }

        return $this->render('SmgNewsBundle:Backend/News:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $news = $em->getRepository('SmgNewsBundle:News')->find($id);

        if (!$news) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $editForm = $this->createForm(new NewsType(), $news);

        return $this->render('SmgNewsBundle:Backend/News:edit.html.twig', array(
            'news'      => $news,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing News entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $news = $em->getRepository('SmgNewsBundle:News')->find($id);

        if (!$news) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $editForm   = $this->createForm(new NewsType(), $news);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($news);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_news_edit', array('id' => $id)));
        }

        return $this->render('SmgNewsBundle:Backend/News:edit.html.twig', array(
            'news'      => $news,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a News entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $news = $em->getRepository('SmgNewsBundle:News')->find($id);
        if (!$news) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }
        $em->remove($news);
        $em->flush();

        return $this->redirect($this->generateUrl('backend_news'));
    }

}
