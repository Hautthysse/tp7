<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/doctrine', name: 'sandbox_doctrine')]
class DoctrineController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listAction(): Response
    {
        $args = array(
        );
        return $this->render('Sandbox/Doctrine/list.html.twig', $args);
    }

    #[Route(
        '/view/{id}',
        name: '_view',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function viewAction(int $id): Response
    {
        $args = array(
        );
        return $this->render('Sandbox/Doctrine/view.html.twig', $args);
    }

    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id): Response
    {
        $this->addFlash('info', 'suppression film ' . $id . ' réussie');
        return $this->redirectToRoute('sandbox_doctrine_list');
    }
}
