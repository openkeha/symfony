<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Entity\Conference;
use App\Entity\Speaker;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
        //return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("<img src='https://symfony.com/images/logos/header-logo.svg' /> Conférences Symfony")
            ->renderContentMaximized();
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Les conférences', 'fas fa-comment', Conference::class);
        yield MenuItem::linkToCrud('Les commentaires', 'fas fa-users', Comment::class);
        yield MenuItem::linkToCrud('Les conférenciers', 'fas fa-users', Speaker::class);
    }
}
