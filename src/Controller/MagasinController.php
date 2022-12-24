<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/magasin', name: 'magasin')]
class MagasinController extends AbstractController
{
    #[Route(
        '/valeur-stock/{id}',
        name: '_valeur_stock',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function valeurStockAction(int $id): Response
    {
        // total fictif en attendant une requête sur la base de données
        $total = 315726;
        $args = array(
            'id' => $id,
            'total' => $total,
        );
        return $this->render('Magasin/valeurStock.html.twig', $args);
    }
}
