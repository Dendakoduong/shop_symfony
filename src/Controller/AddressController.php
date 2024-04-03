<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    #[Route('account/address', name: 'account_address')]
    public function index(): Response
    {
        // Addresses retrieved directly in the view using app.user
        return $this->render('account/address.html.twig', [
        ]);
    }

    #[Route('account/address/new-address', name: 'account_address_new')]
    public function add(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setUser($this->getUser());

            $em->persist($address);
            $em->flush();
            if ($session->get('order') === 1) {       //Redirect to the command if it has been chosen
                $session->set('order', 0);
                return $this->redirectToRoute('order');
            }
            return $this->redirectToRoute('account_address');
        }

        return $this->renderForm('account/address_form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('account/address/edit/{id}', name: 'account_address_update')]
    public function update(Request $request, EntityManagerInterface $em, Address $address = null): Response
    {
        if (!$address || $address->getUser() != $this->getUser()) {
            return $this->redirectToRoute('account_address');
        }

        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setUser($this->getUser());

            $em->flush();
            return $this->redirectToRoute('account_address');
        }

        return $this->renderForm('account/address_form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('account/address/delete/{id}', name: 'account_address_delete')]
    public function delete(EntityManagerInterface $em, Address $address = null): Response
    {
        if ($address && $address->getUser() == $this->getUser()) {
            $em->remove($address);
            $em->flush();
        }

        return $this->redirectToRoute('account_address');
    }
}
