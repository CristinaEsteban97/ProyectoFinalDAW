<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{name}", name="category", methods={"GET"}))
     */
    public function index(): Response
    {
        return $this->render('category/category.html.twig', [
        ]);
    }

}
