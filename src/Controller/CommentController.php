<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CommentRepository;
use App\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



class CommentController extends AbstractController
{

    /**
     * @Route("/comentario/{id}/borrar", name="comment_delete")
     */
    public function delete(Request $request,CommentRepository $commentRepository)
    {
            $entityManager = $this->getDoctrine()->getManager();
            $id = $request->get('id');

            $comment = $entityManager->getRepository('App:Comment')->find($id);
            
            $entityManager->remove($comment);
            $entityManager->flush();
            $this->addFlash('success', '¡Comentario eliminado correctamente!');
            return $this->redirectToRoute('recipe_show',array('title' => $comment->getRecipe()->getTitle()));        

    }
}

