<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;


class ExplorerController extends AbstractController
{
    /**
     * @Route("/explora", name="explorer")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('explorer/explorer.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }
    
}

