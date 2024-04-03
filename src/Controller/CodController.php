<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Service\Mail;
use App\Model\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CodController extends AbstractController
{
    #[Route('/order/checkout/cod/{reference}', name: 'cod_checkout')]
    public function codCheckout($reference, OrderRepository $orderRepository, EntityManagerInterface $entityManager, Cart $cart): Response
    {
        // Fetch the order from the database based on the reference
        $order = $orderRepository->findOneByReference($reference);

        // Update the order state to indicate COD payment method
        $order->setState(4); // Set the state to "Awaiting COD Confirmation"

        // Deduct stock for each product in the order
        foreach ($order->getOrderDetails() as $orderDetail) {
            $product = $orderDetail->getProduct();
            $quantity = $orderDetail->getQuantity();
            $currentStock = $product->getStock();
            $product->setStock($currentStock - $quantity);
            $entityManager->persist($product);
        }

        $entityManager->flush();

        // Remove items from the cart
        $cart->remove();

        // Render the confirmation page with order details
        return $this->render('cod/index.html.twig', [
            'order' => $order
        ]);
    }
}
