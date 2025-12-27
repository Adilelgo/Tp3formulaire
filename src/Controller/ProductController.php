<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\ProductPurchaseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route(path: '/product', name: 'app_product_show')]
    public function show(Request $request): Response
    {
        $form = $this->createForm(ProductPurchaseType::class, null, [
            'action' => '/cart',
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->addFlash('success', 'Product added to cart: ' . json_encode($data));
            return $this->redirectToRoute('app_product_show');
        }

        return $this->render('product/show.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
