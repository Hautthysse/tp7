<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/twig', name: 'sandbox_twig')]
class TwigController extends AbstractController
{
    #[Route(
        '/vue1',
        name: '_vue1'
    )]
    public function vue1Action(): Response
    {
        return $this->render('Sandbox/Twig/vue1.html.twig');
    }
}
