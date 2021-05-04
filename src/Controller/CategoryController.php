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
        $no_recipes = '';
        
        if(!$recipes){  
            $no_recipes = 'No existen aún recetas de la categoria';
        }
        

        return $this->render('category/category.html.twig', [
            'name_category' => $name,
            'recipes' => $recipes,
            'no_recipes' => $no_recipes         
        ]);
    }

}
