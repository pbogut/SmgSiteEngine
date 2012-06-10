<?php

namespace Smg\NewsBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smg\NewsBundle\Entity\News;
use Smg\NewsBundle\Form\NewsType;
use Smg\NewsBundle\Entity\Comment;
use Smg\NewsBundle\Form\CommentType;
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

        return $this->render('SmgNewsBundle:Frontend/News:index.html.twig', array(
            'newses' => $newses
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     */
    public function showAction($id)
    {
        $comment = new Comment();
        $form   = $this->createForm(new CommentType(), $comment);
        
        $em = $this->getDoctrine()->getEntityManager();
                        
        $news = $em->getRepository('SmgNewsBundle:News')->find($id);

        if (!$news) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        return $this->render('SmgNewsBundle:Frontend/News:show.html.twig', array(
            'news'      => $news,
            'form'   => $form->createView(),
            'comment' => $comment
        ));
    }
    
}
