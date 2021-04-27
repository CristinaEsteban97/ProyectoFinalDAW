<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecipeRepository;


class CategoryController extends AbstractController
{
    /**
     * @Route("/categoria/{name}", name="category", methods={"GET"}))
     */
    public function index(RecipeRepository $recipeRepository, string $name): Response
    {
        $recipes = $recipeRepository->findRecipesByCategory($name);
        dump($recipes);
        die;

        return $this->render('category/category.html.twig', [
            'recipes' => $recipes            
        ]);
    }

}
