<?php

namespace Smg\NewsBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smg\NewsBundle\Entity\Comment;
use Smg\NewsBundle\Form\CommentType;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{

    /**
     * Creates a new Comment entity.
     *
     */
    public function createAction($news_id)
    {
        $comment  = new Comment();
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $news = $em->getReference('SmgNewsBundle:News', $news_id);
            $comment->setNews($news);
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('frontend_news_show', array('id' => $news->getId())));
            
        }

        return $this->render('SmgNewsBundle:Frontend/News:show.html.twig', array(
            'id' => $news_id,
            'form'   => $form->createView()
        ));
    }
}
