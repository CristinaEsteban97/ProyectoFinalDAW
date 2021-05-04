<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchType;
use App\Repository\RecipeRepository;


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
    public function search(Request $request, RecipeRepository $recipeRepository)
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

        }

        
        return $this->render('search/index.html.twig', [
            'text' => $text,
            'recipes' => $recipes,
            'totalResults' => $totalResults,
            'no_recipes' => $no_recipes

        ]);
    }
}
