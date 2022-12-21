<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/route', name: 'sandbox_route')]
class RouteController extends AbstractController
{
    #[Route('', name: '')]
    public function indexAction(): Response
    {
        return new Response('<body>RouteController</body>');
    }
}
