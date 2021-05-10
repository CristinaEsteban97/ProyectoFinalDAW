<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecipeRepository;
use App\Repository\ScoreRepository;


class CategoryController extends AbstractController
{
    /**
     * @Route("/categoria/{name}", name="category", methods={"GET"}))
     */
    public function index(RecipeRepository $recipeRepository,ScoreRepository $scoreRepository, string $name): Response
    {
        $recipes = $recipeRepository->findRecipesByCategory($name);
        $no_recipes = '';
        $totalScores=[];
        $no_score='';
        
        if(!$recipes){  
            $no_recipes = 'No existen aún recetas de la categoria';
        }        
        $sum_score=0;
        for ($i=0; $i <count($recipes) ; $i++) { 
            $scoresByRecipe=0;
            $sum_score=0;
            $scoresByRecipe = $scoreRepository->findBy(array('recipe' => $recipes[$i]->getId()));
            if($scoresByRecipe !=[]){
                for ($x=0; $x < count($scoresByRecipe); $x++) { 
                    $sum_score += $scoresByRecipe[$x]->getScore();
                }

                    $totalScores[$i] = $sum_score/count($scoresByRecipe);
            }else{
                $no_score = "No existen valoraciones";
                $totalScores[$i]= $no_score;

            }
        }

        return $this->render('category/category.html.twig', [
            'name_category' => $name,
            'recipes' => $recipes,
            'no_recipes' => $no_recipes, 
            'totalScores' => $totalScores      
        ]);
    }

}
