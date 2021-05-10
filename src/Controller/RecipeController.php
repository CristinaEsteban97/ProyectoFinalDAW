<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Score;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UploadRecipesType;
use App\Form\CommentType;
use App\Form\ScoreType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Controller\ObjectManager;
use DateTime;


class RecipeController extends AbstractController
{
    // /**
    //  * @Route("/recetas", name="recipes")
    //  */
    // public function index(RecipeRepository $recipeRepository): Response
    // {
    //     return $this->render('recipe/index.html.twig', [
    //         'recipes' => $recipeRepository->findBy(['visible' => 'true'])
    //     ]);
    // }

    /**
     * @Route("/subir_receta", name="recipe_new")
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(UploadRecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setVisible(0);
            $user = $this->getUser();
            $recipe->setUser($user);

            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = iconv('UTF-8', 'ASCII//TRANSLIT', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                $image->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $recipe->setImage($newFilename);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', '¡Receta subida correctamente!');

        }

        return $this->render('recipe/new/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/receta/{title}", name="recipe_show", methods={"GET"})
     * @Route("/receta/{title}", name="recipe_show")
     */
    public function show(Recipe $recipe,RecipeRepository $recipeRepository,CommentRepository $commentRepository, Request $request): Response
    { 
        $comment = new Comment();
        $score = new Score();

        $comment_form = $this->createForm(CommentType::class, $comment);
        $comment_form->handleRequest($request);
        
        $score_form = $this->createForm(ScoreType::class, $score);
        $score_form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($score_form->isSubmitted() && $score_form->isValid()) {
            $score_value = $score_form->get("score")->getData();
            
            if($score_value != null){
                $score->setScore($score_value); 
                $score->setRecipe($recipe); 
                $score->setUser($user);
                $entityManager->persist($score); 
                $entityManager->flush();  

                $this->addFlash('success', 'Puntuación registrada con exito! Tu puntuación estará visible una vez que el administrador lo revise.');
                return $this->redirect($request->getUri());  
            } 
        }   

        if ($comment_form->isSubmitted() && $comment_form->isValid()) {

            $parentid = $comment_form->get("parent")->getData();

            if($parentid != null){
                $parent = $entityManager->getRepository(Comment::class)->find($parentid);
            }

            $comment->setVisible(0);
            $comment->setParent($parent ?? null);
            $comment->setUser($user);
            $comment->setRecipe($recipe);
            $comment->setCreatedAt(new DateTime());
         

            $entityManager->persist($comment);
            $entityManager->flush();  

            $this->addFlash('success', '¡Comentario registrado con exito! Tu comentario estará visible una vez que el administrador lo revise.');
            return $this->redirect($request->getUri());     
        }

        $comments = $commentRepository->findCommentsByRecipe($recipe);
        

        return $this->render('recipe/show/show.html.twig', [
            'recipe' => $recipe,
            'score_form' => $score_form->createView(),
            'comment_form' => $comment_form->createView(),
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/receta/{title}/editar", name="recipe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/receta/{title}/borrar", name="recipe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Recipe $recipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipe_index');
    }
}
