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

        
        if($recipes){  // If there are recipes of this category with visible = 0

        }else{  // If there aren't recipes of this category with visible = 0
            echo "Hola";
        }
        

        return $this->render('category/category.html.twig', [
            'recipes' => $recipes            
        ]);
    }

}
