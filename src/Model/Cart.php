<?php

namespace App\Model;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Allows to manage a shopping cart in session rather than implementing everything in the controller
 */
class Cart
{
    private $session;

    public function __construct(SessionInterface $session, ProductRepository $repository)
    {
        $this->session = $session;
        $this->repository = $repository;
    }


    /**
     * Create an associative array id => quantity and store it in session
     *
     * @param int $id
     * @return void
     */
    public function add(int $id): void
    {
        $cart = $this->session->get('cart', []);

        if (empty($cart[$id])) {
            $cart[$id] = 1;
        } else {
            $cart[$id]++;
        }

        $this->session->set('cart', $cart);
    }

    /**
     * Retrieves the shopping cart in session
     *
     * @return array
     */
    public function get(): array
    {
        return $this->session->get('cart');
    }


    /**
     * Completely removes the in-session cart
     *
     * @return void
     */
    public function remove(): void
    {
        $this->session->remove('cart');
    }


    /**
     * Completely removes a product from the basket (regardless of its quantity)
     *
     * @param int $id
     * @return void
     */
    public function removeItem(int $id): void
    {
        $cart = $this->session->get('cart', []);
        unset($cart[$id]);
        $this->session->set('cart', $cart);
    }


    /**
     * Decreases the quantity of a product by 1
     *
     * @param int $id
     * @return void
     */
    public function decreaseItem(int $id): void
    {
        $cart = $this->session->get('cart', []);
        if ($cart[$id] < 2) {
            unset($cart[$id]);
        } else {
            $cart[$id]--;
        }
        $this->session->set('cart', $cart);
    }


    /**
     * Retrieves the cart in session, then retrieves the product objects from the database
     * and calculates the totals
     *
     * @return array
     */
    public function getDetails(): array
    {
        $cartProducts = [
            'products' => [],
            'totals' => [
                'quantity' => 0,
                'price' => 0,
            ],
        ];

        $cart = $this->session->get('cart', []);
        if ($cart) {
            foreach ($cart as $id => $quantity) {
                $currentProduct = $this->repository->find($id);
                if ($currentProduct) {
                    $cartProducts['products'][] = [
                        'product' => $currentProduct,
                        'quantity' => $quantity
                    ];
                    $cartProducts['totals']['quantity'] += $quantity;
                    $cartProducts['totals']['price'] += $quantity * $currentProduct->getPrice();
                }
            }
        }
        return $cartProducts;
    }

    public function getQuantity($productId)
    {
        $cart = $this->session->get('cart', []);
        if (!isset($cart[$productId])) {
            return 0;
        }

        return $cart[$productId];
    }
}
