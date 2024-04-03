<?php

namespace App\Controller;

use App\Entity\Order;
use App\Model\Cart;
use App\Repository\OrderRepository;
use App\Service\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * Verification stage before confirmation of payment
     */
    #[Route('/order/checkout/{reference}', name: 'checkout')]
    public function payment(OrderRepository $repository, $reference, EntityManagerInterface $em): Response
    {
        // Retrieving products from last order and formatting into an array for Stripe
        $order = $repository->findOneByReference($reference);
        if (!$order) {
            throw $this->createNotFoundException('This order does not exist');
        }
        $products = $order->getOrderDetails()->getValues();
        $productsForStripe = [];
        foreach ($products as $item) {
            $productsForStripe[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $item->getPrice(),
                    'product_data' => [
                        'name' => $item->getProduct()->getName() // Change this line
                    ]
                ],
                'quantity' => $item->getQuantity()
            ];
        }
        // Add shipping fee
        $productsForStripe[] = [
            'price_data' => [
                'currency' => 'usd',
                'unit_amount' => $order->getCarrierPrice(),
                'product_data' => [
                    'name' => $order->getCarrierName()
                ]
            ],
            'quantity' => 1
        ];
        Stripe::setApiKey('sk_test_51NUQolJ2uxGxKKkq9Ek90tltgwSCs666v2vyhbg6XoshVFE0QuSz35epWtfOtXqooeVFizilYJg7tELS1ayPTQoj00zel9HeDE');
        header('Content-Type: application/json');

        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';

        // Create Stripe session with the cart data
        $checkout_session = Session::create([
            'line_items' => $productsForStripe,
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'order/success/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . 'order/fail/{CHECKOUT_SESSION_ID}',
        ]);
        $order->setStripeSession($checkout_session->id);
        $em->flush();
        return $this->redirect($checkout_session->url);
    }



    /**
     * Method called when the payment is validated
     */
    #[Route('/order/success/{stripeSession}', name: 'payment_success')]
    public function paymentSuccess(OrderRepository $repository, $stripeSession, EntityManagerInterface $em, Cart $cart)
    {
        $order = $repository->findOneByStripeSession($stripeSession);
        if (!$order || $order->getUser() != $this->getUser()) {
            throw $this->createNotFoundException('Order inaccessible');
        }
        if (!$order->getState()) {
            $order->setState(1);
            // Deduct stock for each product in the order
            foreach ($order->getOrderDetails() as $orderDetail) {
                $product = $orderDetail->getProduct();
                $quantity = $orderDetail->getQuantity();
                $currentStock = $product->getStock();
                $product->setStock($currentStock - $quantity);
                $em->persist($product);
            }
            $em->flush();
        }



        // Deletion of the basket once the order has been validated
        $cart->remove();
        return $this->render('payment/success.html.twig', [
            'order' => $order
        ]);
    }

    /**
     * Order canceled (click on return in the window)
     */
    #[Route('/order/fail/{stripeSession}', name: 'payment_fail')]
    public function paymentFail(OrderRepository $repository, $stripeSession)
    {
        $order = $repository->findOneByStripeSession($stripeSession);
        if (!$order || $order->getUser() != $this->getUser()) {
            throw $this->createNotFoundException('Something went wrong. Try again later');
        }

        return $this->render('payment/fail.html.twig', [
            'order' => $order
        ]);
    }
}
