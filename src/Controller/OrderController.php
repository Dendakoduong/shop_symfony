<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\OrderType;
use App\Model\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * Retrieval cart, choose address, carrier
     *
     * @param SessionInterface $session
     * @param Cart $cart
     * @return Response
     */
    #[Route('/order', name: 'order')]
    public function index(SessionInterface $session, Cart $cart): Response
    {
        $user = $this->getUser();
        $cartProducts = $cart->getDetails();

        //Redirection if cart empty
        if (empty($cartProducts['products'])) {
            return $this->redirectToRoute('product');
        }

        //Redirection if user does not have an address
        if (!$user->getAddresses()->getValues()) {      //getValues() Directly retrieves values from a collection of objects
            $this->addFlash('warning', 'You need to add an address first.');
            $session->set('order', 1);
            return $this->redirectToRoute('account_address_new');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $user    //Allows to pass the current user in the array of OrderType options
        ]);

        return $this->renderForm('order/index.html.twig', [
            'form' => $form,
            'cart' => $cartProducts,
            'totalPrice' => $cartProducts['totals']['price']
        ]);
    }

    /**
     * Registration of "hard" data of the order containing address, carrier and products
     * Relationships are not directly used for data persistence in Order and OrderDetails entities
     * to avoid inconsistencies in the event that modifications are made to other entities later
     *
     * @param Cart $cart
     * @param Request $request
     * @return Response
     */
    #[Route('/order/total', name: 'order_add', methods: 'POST')] // /order/total
    public function summary(Cart $cart, Request $request, EntityManagerInterface $em): Response
    {
        //Retrieve cart in session
        $cartProducts = $cart->getDetails();

        //Verification that a form has been sent previously
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $address = $form->get('addresses')->getData();

            $delivery_string = $address->getFirstname() . ' ' . $address->getLastname();
            $delivery_string .= '<br>' . $address->getPhone();
            $delivery_string .= '<br>' . $address->getAddress();
            $delivery_string .= '<br>' . $address->getPostal();
            $delivery_string .= '<br>' . $address->getCity();
            $delivery_string .= ', ' . $address->getCountry();
            $delivery_string .= '<br>' . $address->getCompany() ?? '';
            //$delivery_string .= '<br>' . $address->getCity() . ', ' . $address->getCountry();

            $cartProducts = $cart->getDetails();

            //Create the order with the form info
            $order = new Order;
            $date = new \DateTime;
            $order
                ->setUser($this->getUser())
                ->setCreatedAt($date)
                ->setCarrierName($form->get('carriers')->getData()->getName())
                ->setCarrierPrice($form->get('carriers')->getData()->getPrice())
                ->setDelivery($delivery_string)
                ->setState(0)
                ->setReference($date->format('YmdHis') . '-' . uniqid());
            // Set the delivery attribute before persisting the order
            $order->setDelivery($delivery_string);
            $em->persist($order);

            //Create detail lines for each of the products in the order
            foreach ($cartProducts['products'] as $item) {
                $orderDetails = new OrderDetails();
                $orderDetails
                    ->setBindedOrder($order)
                    ->setProduct($item['product']) // Change this line
                    ->setQuantity($item['quantity'])
                    ->setPrice($item['product']->getPrice())
                    ->setTotal($item['product']->getPrice() * $item['quantity']);
                $em->persist($orderDetails);
            }
            $em->flush();

            // Show total price
            return $this->renderForm('order/add.html.twig', [
                'cart' => $cartProducts,
                'totalPrice' => $cartProducts['totals']['price'],
                'order' => $order
            ]);
        }
        //If no form, page not accessible, and redirection to cart
        return $this->redirectToRoute('cart');
    }

}
