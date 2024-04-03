<?php
// src/Controller/DashboardController.php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\Entity\Product; // Make sure to import your Product entity
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
  /**
   * @Route("/dashboard", name="dashboard")
   */
  public function index(EntityManagerInterface $em)
  {
    /*$totalOrders = count($em->getRepository(Order::class)->findAll());
    $totalUsers = count($em->getRepository(User::class)->findAll());

    // Calculate total money received
    $orders = $em->getRepository(Order::class)->findAll();
    $totalMoneyReceived = 0;
    foreach ($orders as $order) {
      $totalMoneyReceived += $order->getTotal();
    }

    // Count total products
    $totalProducts = count($em->getRepository(Product::class)->findAll());

    return $this->render('dashboard/index.html.twig', [
      'totalOrders' => $totalOrders,
      'totalUsers' => $totalUsers,
      'totalMoneyReceived' => $totalMoneyReceived,
      'totalProducts' => $totalProducts, // Pass totalProducts to the template
    ]);*/
    $totalOrders = count($em->getRepository(Order::class)->findAll());
    $totalUsers = count($em->getRepository(User::class)->findAll());

    // Calculate total money received
    $orders = $em->getRepository(Order::class)->findAll();
    $totalMoneyReceived = 0;
    $moneyReceivedOverTime = [];
    foreach ($orders as $order) {
      $totalMoneyReceived += $order->getTotal();
      $date = $order->getCreatedAt()->format('Y-m-d');
      if (!isset($moneyReceivedOverTime[$date])) {
        $moneyReceivedOverTime[$date] = 0;
      }
      $moneyReceivedOverTime[$date] += $order->getTotal();
    }
    // Convert the money from cents to dollars
    $moneyReceivedOverTime = array_map(function ($value) {
      return $value / 100;
    }, $moneyReceivedOverTime);

    // Count total products
    $totalProducts = count($em->getRepository(Product::class)->findAll());

    //order by date
    $ordersOverTime = [];
    foreach ($orders as $order) {
      $date = $order->getCreatedAt()->format('Y-m-d');
      if (!isset($ordersOverTime[$date])) {
        $ordersOverTime[$date] = 0;
      }
      $ordersOverTime[$date]++;
    }

    //rank users by orders
    $userOrders = [];
    foreach ($orders as $order) {
      $user = $order->getUser()->getUsername();
      if (!isset($userOrders[$user])) {
        $userOrders[$user] = 0;
      }
      $userOrders[$user]++;
    }

    // Sort users by number of orders in descending order
    arsort($userOrders);

    //rank products by sales
    $productSales = [];
    foreach ($orders as $order) {
      foreach ($order->getOrderDetails() as $detail) {
        $product = $detail->getProduct()->getName();
        if (!isset($productSales[$product])) {
          $productSales[$product] = 0;
        }
        $productSales[$product] += $detail->getQuantity();
      }
    }

    // Sort products by number of sales in descending order
    arsort($productSales);

    // Limit to top 5
    $productSales = array_slice($productSales, 0, 5, true);

    //hard to sell
    /* $productSales = [];
    foreach ($orders as $order) {
      foreach ($order->getOrderDetails() as $detail) {
        $product = $detail->getProduct()->getName();
        if (!isset($productSales[$product])) {
          $productSales[$product] = 0;
        }
        $productSales[$product] += $detail->getQuantity();
      }
    }*/
    // Sort products by number of sales in ascending order
    asort($productSales);

    // Limit to top 5
    $hardToSellProducts = array_slice($productSales, 0, 5, true);
    // Count products by category
    $productRepository = $em->getRepository(Product::class);
    $products = $productRepository->findAll();
    $productsByCategory = [];
    foreach ($products as $product) {
      $category = $product->getCategory()->getName();
      if (!isset($productsByCategory[$category])) {
        $productsByCategory[$category] = 0;
      }
      $productsByCategory[$category]++;
    }


    return $this->render('dashboard/index.html.twig', [
      'totalOrders' => $totalOrders,
      'totalUsers' => $totalUsers,
      'totalMoneyReceived' => $totalMoneyReceived,
      'totalProducts' => $totalProducts,
      'dates' => array_keys($moneyReceivedOverTime),
      'moneyReceived' => array_values($moneyReceivedOverTime),
      'orders' => array_values($ordersOverTime),
      'userOrders' => $userOrders,
      'productSales' => $productSales,
      'hardToSellProducts' => $hardToSellProducts,
      'productsByCategory' => $productsByCategory,
    ]);
  }
}
