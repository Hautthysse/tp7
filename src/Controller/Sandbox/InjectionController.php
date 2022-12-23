<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/injection', name: 'sandbox_injection')]
class InjectionController extends AbstractController
{
    #[Route('/un', name: '_un')]
    public function unAction(Request $request): Response
    {
        dump($request->getMethod());
        dump($request->query->get('foo'));
        dump($request->query->all());
        dump($request->cookies->all());
        return new Response('<body>Injection::un</body>');
    }
}
