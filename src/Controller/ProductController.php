<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ProductRepository;
use App\Model\Search;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product')]
    public function index(ProductRepository $repository, Request $request): Response
    {

        // If search is executed, $products will contain the filtered results
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $products = $repository->findWithSearch($search);
        } else {
            $products = $repository->findAll();
        }


        return $this->renderForm('product/index.html.twig', [
            'products' => $products,
            'form' => $form,
        ]);
    }

    //no suggested products
    /*#[Route('/products/{slug}', name: 'product_show')]
    public function show(ProductRepository $repository, string $slug): Response
    {
        $product = $repository->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('product');
        }
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }*/

    //3 products per page beta
    /*#[Route('/products/{slug}', name: 'product_show')]
    public function show(ProductRepository $repository, string $slug): Response
    {
        $product = $repository->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('product');
        }

        // Fetch the suggested products from the same category
        $suggestedProducts = $repository->findBy(['category' => $product->getCategory()]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'suggestedProducts' => $suggestedProducts,
        ]);
    }*/

    #[Route('/products/{slug}/{page<\d+>?1}', name: 'product_show')]
    public function show(ProductRepository $repository, string $slug, int $page): Response
    {
        $product = $repository->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('product');
        }
        // Fetch the suggested products from the same category
        $suggestedProducts = $repository->findBy(['category' => $product->getCategory()]);
        // Remove the current product from the suggested products
        $suggestedProducts = array_filter($suggestedProducts, function ($suggestedProduct) use ($product) {
            return $suggestedProduct->getId() !== $product->getId();
        });
        // Calculate the total pages
        $totalPages = ceil(count($suggestedProducts) / 3); // replace 3 with the number of products per page
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'suggestedProducts' => array_slice($suggestedProducts, ($page - 1) * 3, 3), // replace 3 with the number of products per page
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}
