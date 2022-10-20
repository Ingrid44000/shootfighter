<?php

namespace App\Controller\Admin;

use App\Entity\Actualites;
use App\Entity\Recompenses;
use App\Entity\Tournois;
use App\Entity\Participants;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(TournoisCrudController::class)->generateUrl();
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Shootfighter');
    }

    public function configureMenuItems(): iterable
    {


        yield MenuItem::linktoRoute('Retour à l accueil ', 'fas fa-home', 'app_login');
        yield MenuItem::linkToCrud('Participants', 'fas fa -participants', Participants::class);
        yield MenuItem::linkToCrud('Tournois', 'fas fa -tournois', Tournois::class);
        yield MenuItem::linkToCrud('Actualités', 'fas fa -actualites', Actualites::class);
        yield MenuItem::linkToCrud('Récompenses', 'fas fa -recompenses', Recompenses::class);

    }
}
