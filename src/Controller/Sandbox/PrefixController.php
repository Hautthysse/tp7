<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrefixController extends AbstractController
{
    #[Route('/sandbox/prefix', name: 'sandbox_prefix')]
    public function indexAction(): Response
    {
        return new Response('<body>(Prefix) Hello World!</body>');
    }

    #[Route('/sandbox/prefix/hello2', name: 'sandbox_prefix_hello2')]
    public function hello2Action(): Response
    {
        return $this->render('Sandbox/Prefix/hello2.html.twig');
    }

    #[Route('/sandbox/prefix/hello3', name: 'sandbox_prefix_hello3')]
    public function hello3Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => ['A Plague Tale : Innocence', 'WoW', "Mass Effect", 'Life is Strange'],
        );
        return $this->render('Sandbox/Prefix/hello3.html.twig', $args);
    }

    #[Route('/sandbox/prefix/hello4', name: 'sandbox_prefix_hello4')]
    public function hello4Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => ['A Plague Tale : Innocence', 'WoW', "Mass Effect", 'Life is Strange'],
        );
        return $this->render('Sandbox/Prefix/hello4.html.twig', $args);
    }
}
