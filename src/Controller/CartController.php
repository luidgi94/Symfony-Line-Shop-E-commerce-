<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(CartService $cartService) 
    // Le CartService a été créer dans le but de moins encombrer le controller par diverses fonctions 
    // et permet ainsi en plus du côté ergonomique, de pouvoir réutiliser ces fonctions dans n'importe quel projet...
    {

        $form = $this->createFormBuilder()
        ->add('search', TextType::class)
        ->add('send', SubmitType::class, ['label' => 'Rechercher'])
        ->getForm();
        
       
        return $this->render('cart/index.html.twig', [
            'form' => $form->createView(),
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal() 
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/cart/delete/{id}", name="cart_delete")
     */
    public function delete($id, CartService $cartService)
    {
        $cartService->delete($id);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute("cart_index");
    }
}
