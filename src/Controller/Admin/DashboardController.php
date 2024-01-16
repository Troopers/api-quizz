<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Quizz;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private readonly AdminUrlGenerator $adminUrlGenerator,
    ) {
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(QuestionCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Srv');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'bi bi-house');
         yield MenuItem::linkToCrud('Question', 'bi bi-list', Question::class);
         yield MenuItem::linkToCrud('Quizz', 'bi bi-list', Quizz::class);
    }
}
