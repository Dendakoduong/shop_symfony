<?php

namespace App\Controller\Moderator;

use App\Controller\Admin\OrderCrudController;
//use App\Entity\Carrier;
use App\Entity\Category;
use App\Entity\Headers;
use App\Entity\Order;
use App\Entity\Product;
//use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/mod", name="mod")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(OrderCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Moderator panel');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Back to homepage', 'fas fa-angle-left', $this->generateUrl('home'));
        yield MenuItem::linkToDashboard('Main', 'fa fa-home');
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Product', 'fas fa-tag', Product::class);
        //yield MenuItem::linkToCrud('Delivery', 'fas fa-truck', Carrier::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-shopping-cart', Order::class);
        yield MenuItem::linkToCrud('Carousel', 'fas fa-desktop', Headers::class);
    }
}
