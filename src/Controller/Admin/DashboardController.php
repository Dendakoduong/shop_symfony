<?php

namespace App\Controller\Admin;

use App\Entity\Carrier;
use App\Entity\Category;
use App\Entity\Headers;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        /*$totalOrders = count($this->getDoctrine()->getRepository(Order::class)->findAll());
        $totalUsers = count($this->getDoctrine()->getRepository(User::class)->findAll());

        return $this->render('admin/dashboard.html.twig', [
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
        ]);*/
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(OrderCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Back to homepage', 'fas fa-angle-left', $this->generateUrl('home'));
        yield MenuItem::linkToRoute('Dashboard', 'fa fa-chart-line', 'dashboard');
        yield MenuItem::linkToDashboard('Main', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Product', 'fas fa-tag', Product::class);
        yield MenuItem::linkToCrud('Delivery', 'fas fa-truck', Carrier::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-shopping-cart', Order::class);
        yield MenuItem::linkToCrud('Carousel', 'fas fa-desktop', Headers::class);
    }
}
