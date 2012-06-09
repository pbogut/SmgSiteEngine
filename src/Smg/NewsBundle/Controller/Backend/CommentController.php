<?php

namespace Smg\NewsBundle\Controller\Backend;

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
     * Deletes a Comment entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $comment = $em->getRepository('SmgNewsBundle:Comment')->find($id);
        if (!$comment) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }
        $news = $comment->getNews();
        $em->remove($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('backend_news_edit', array(
            'id' => $news->getId()
        )));
    }

}
