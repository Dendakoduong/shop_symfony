<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\ChangePasswordType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * User area controller
 */
class AccountController extends AbstractController
{
    #[Route('/account', name: 'account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
        ]);
    }

    /**
     * Allows modification of a user's password on a dedicated page
     */
    #[Route('/account/change-password', name: 'account_password')]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_password = $form->get('old_password')->getData();
            $new_password = $form->get('new_password')->getData();
            $isOldPasswordValid = $passwordHasher->isPasswordValid($user, $old_password);
            if ($isOldPasswordValid) {
                $password = $passwordHasher->hashPassword($user,$new_password);
                $user->setPassword($password);
                $em->flush();
                $this->addFlash(
                    'notice',
                    'Password has been changed! :)'
                );
                return $this->redirectToRoute('account');
            } else {
                $this->addFlash(
                    'notice',
                    'Wrong current password :('
                );
            }
        }

        return $this->renderForm('account/password.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * Shows all orders
     */
    #[Route('/account/orders', name: 'account_orders')]
    public function showOrders(OrderRepository $repository): Response
    {
        $orders = $repository->findPaidOrdersByUser($this->getUser());
        return $this->render('account/orders.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * Show order
     */
    #[Route('/account/orders/{reference}', name: 'account_order')]
    public function showOrder(Order $order): Response
    {
        if (!$order || $order->getUser() != $this->getUser()) {
            throw $this->createNotFoundException('Order not available!');
        }
        return $this->render('account/order.html.twig', [
            'order' => $order
        ]);
    }
}
