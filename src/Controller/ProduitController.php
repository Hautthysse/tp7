<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name: 'produit')]
class ProduitController extends AbstractController
{
    #[Route(
        '/list/{page}',
        name: '_list',
        requirements: ['page' => '[1-9]\d*'],
        defaults: [ 'page' => 0],        // la valeur par défaut ne respecte pas les contraintes
    )]
    public function listAction(int $page): Response
    {
        $args = array(
            'page' => $page,
            'produits' => array(
                ['id' => 2, 'denomination' => 'RAM',     'code' => '97558143', "actif" => false],
                ['id' => 5, 'denomination' => 'souris',  'code' => '35425785', "actif" => true],
                ['id' => 6, 'denomination' => 'clavier', 'code' => '33278214', "actif" => true],
            ),
        );
        return $this->render('Produit/list.html.twig', $args);
    }
}
