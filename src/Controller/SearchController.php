<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchType;
use App\Repository\RecipeRepository;
use App\Repository\ScoreRepository;

class SearchController extends AbstractController
{

    public function searchBar(Request $request)
    {
        $form = $this->createForm(SearchType::class, null);
        return $this->render('search/searchForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/busqueda", name="search")
     */
    public function search(Request $request, RecipeRepository $recipeRepository,ScoreRepository $scoreRepository)
    {
        $form = $this->createForm(SearchType::class, null);
        $form->handleRequest($request);
        $text = null;
        $recipes ='';
        $no_recipes='';
        $totalResults= null;

        if ($form->isSubmitted() && $form->isValid()) {
            $text = $form->get('search')->getData();
            $text = htmlspecialchars(addslashes(trim($text)));
            
            $recipes = $recipeRepository->findRecipesBySearch($text);
            $totalResults = count($recipes);

            if(!$recipes){  
                $no_recipes = 'No existe ninguna receta con paara esa búsqueda';
            }

            $totalScores=[];
            $no_score='';
    
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

        }

        
        return $this->render('search/index.html.twig', [
            'text' => $text,
            'recipes' => $recipes,
            'totalResults' => $totalResults,
            'no_recipes' => $no_recipes,
            'no_recipes' => $no_recipes, 
            'totalScores' => $totalScores
        ]);
    }
}
