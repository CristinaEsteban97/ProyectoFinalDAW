<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Score;
use App\Entity\Recipe;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(RecipeCrudController::class)->generateUrl());

        // you can also redirect to different pages depending on the current user
        if ('jane' === $this->getUser()->getUsername()) {
            return $this->redirect('...');
        }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Inicio', 'fa fa-home'),
            MenuItem::section('Menú'),
            MenuItem::linkToCrud('Recetas', 'fa fa-cutlery', Recipe::class),
            MenuItem::linkToCrud('Comentarios', 'fa fa-comment', Comment::class),
            MenuItem::linkToCrud('Puntuaciones', 'fa fa-star', Score::class),
            MenuItem::linkToCrud('Categorias', 'fa fa-tags', Category::class),
            MenuItem::linkToCrud('Usuarios', 'fa fa-user', User::class),
        ];
    }
}