<?php

namespace App\Service\Cart;

use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $gameRepository;

    public function __construct(SessionInterface $session, GameRepository $gameRepository)
    {
        $this->session = $session;
        $this->gameRepository = $gameRepository;
    }

    public function add(int $id) 
    {
        
        $panier = $this->session->get("panier", []);
        if (!empty($panier[$id]))
        {
            $panier[$id]++;
        }
        else
        {
            $panier[$id] = 1;
        }
       
        $this->session->set("panier",$panier);
    }

    public function delete(int $id) 
    {
        $panier = $this->session->get("panier", []);
        if (!empty($panier[$id]))
        {
            $panier[$id]--;
        }
        
        $this->session->set('panier', $panier);
    }

    public function remove(int $id) 
    {
        $panier = $this->session->get("panier", []);
        if (!empty($panier[$id]))
        {
           unset($panier[$id]);
        }
        
        $this->session->set('panier', $panier);
    }

    public function getFullCart() : array 
    {
        $panier = $this->session->get("panier", []);
        $panierDetails = [];

        foreach($panier as $id => $qte)
        {
            $panierDetails[]= [
                'article' => $this->gameRepository->find($id),
                'quantite' => $qte
            ];

        }

        return $panierDetails;
    }

    public function getTotal() : float 
    {
        $total = 0;

        foreach ($this->getFullCart() as $item) 
        {
            $total += $item['article']->getPrice() * $item['quantite'];       
        }

        return $total;
    }
}