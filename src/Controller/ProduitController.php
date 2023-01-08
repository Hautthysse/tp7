<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name: 'produit')]
class ProduitController extends AbstractController
{
    #[Route('', name: '')]
    public function indexAction(): Response
    {
        return $this->redirectToRoute('produit_list', ['page' => 1]);
    }

    #[Route(
        '/list/{page}',
        name: '_list',
        requirements: ['page' => '[1-9]\d*'],
        defaults: [ 'page' => 0],        // la valeur par défaut ne respecte pas les contraintes
    )]
    public function listAction(int $page, EntityManagerInterface $em): Response
    {
        $produitRepository = $em->getRepository(Produit::class);
        $produits = $produitRepository->findAll();
        $args = array(
            'page' => $page,
            'produits' => $produits,
        );
        return $this->render('Produit/list.html.twig', $args);
    }

    #[Route(
        '/view/{id}',
        name: '_view',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function viewAction(int $id, EntityManagerInterface $em): Response
    {
        $produitRepository = $em->getRepository(Produit::class);
        $produit = $produitRepository->find($id);

        if (is_null($produit))
        {
            $this->addFlash('info', 'view : produit ' . $id . ' inexistant');
            return $this->redirectToRoute('produit_list');
        }

        $args = array(
            'produit' => $produit,
        );
        return $this->render('Produit/view.html.twig', $args);
    }

    #[Route(
        '/add',
        name: '_add',
    )]
    public function addAction(): Response
    {
        $this->addFlash('info', 'échec ajout produit');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    #[Route(
        '/edit/{id}',
        name: '_edit',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function editAction(int $id): Response
    {
        $this->addFlash('info', 'échec modification produit ' . $id);
        return $this->redirectToRoute('produit_view', ['id' => $id]);
   }

    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id, EntityManagerInterface $em): Response
    {
        $produitRepository = $em->getRepository(Produit::class);
        $produit = $produitRepository->find($id);

        if (is_null($produit))
            throw new NotFoundHttpException('erreur suppression produit ' . $id);

        $em->remove($produit);
        $em->flush();
        $this->addFlash('info', 'suppression produit ' . $id . ' réussie');

        return $this->redirectToRoute('produit_list');
    }

    #[Route(
        '/pays/add',
        name: '_pays_add',
    )]
    public function paysAddAction(): Response
    {
        $this->addFlash('info', 'échec ajout relation produit/pays');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    #[Route(
        '/magasin/add',
        name: '_magasin_add',
    )]
    public function magasinAddAction(): Response
    {
        $this->addFlash('info', 'échec ajout relation produit/magasin');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    /**
     * test de QueryBuilder
     */
    #[Route(
        '/viewQB/{id}/{method}',
        name: '_view_qb',
        requirements: [
            'id' => '[1-9]\d*',
            'method' => 'avec|sans',
        ],
    )]
    public function viewQB(int $id, string $method, EntityManagerInterface $em)
    {
        $produitRepository = $em->getRepository(Produit::class);

        if ($method === 'avec')
            $produit = $produitRepository->findWithMagasins($id);
        else
            $produit = $produitRepository->find($id);
        if (is_null($produit))
            throw new NotFoundHttpException('erreur viewQB produit ' . $id);

        $args = array(
            'method' => $method,
            'produit' => $produit,
        );
        return $this->render('Produit/viewQB.html.twig', $args);
    }
}
