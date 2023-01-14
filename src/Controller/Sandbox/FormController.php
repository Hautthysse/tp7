<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/form', name: 'sandbox_form')]
class FormController extends AbstractController
{
    #[Route('', name: '')]
    public function index(): Response
    {
        return new Response('<body>test contrôleur Form</body>');
    }
}
