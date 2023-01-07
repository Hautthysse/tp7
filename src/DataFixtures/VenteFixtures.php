<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Manuel;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VenteFixtures extends Fixture
{
    public function load(ObjectManager $em): void
    {
        /* ===========================================================
         * = produit 1
         * ===========================================================*/
        // pas de manuel

        $produit1 = new Produit();
        $produit1
            ->setDenomination('voiture')
            ->setCode('7 11 654 876')
            ->setDateCreation(new \DateTime())
            ->setActif(true)
            ->setDescriptif('descriptif 11111')
            ->setManuel(null);      // inutile car valeur par défaut
        $em->persist($produit1);

        $image1_1 = new Image();
        $image1_1
            ->setUrl('http://image1_1')
            ->setUrlMini('http://ahg893vdx')
            ->setAlt('une image 1 1')
            ->setProduit($produit1);
        $em->persist($image1_1);

        $image1_2 = new Image();
        $image1_2
            ->setUrl('http://image1_2')
            ->setUrlMini(null)               // valeur par défaut
            ->setAlt('une image 1 2')
            ->setProduit($produit1);
        $em->persist($image1_2);


        /* ===========================================================
         * = produit 2
         * ===========================================================*/
        $manuel2 = new Manuel();
        $manuel2
            ->setUrl('http://aaaaa')
            ->setSommaire('I titre; II pas titre');
        $em->persist($manuel2);

        $produit2 = new Produit();
        $produit2
            ->setDenomination('skate')
            ->setCode('5 21 749 559')
            ->setDateCreation(new \DateTime())
            ->setActif(true)
            ->setDescriptif('descriptif 22222')
            ->setManuel($manuel2);
        $em->persist($produit2);

        $image2_1 = new Image();
        $image2_1
            ->setUrl('http://image2_1')
            ->setUrlMini('http://jsg09gr')
            ->setAlt('une image 2 1')
            ->setProduit($produit2);
        $em->persist($image2_1);

        $image2_2 = new Image();
        $image2_2
            ->setUrl('http://image2_2')
            ->setUrlMini('http://gh38mf')
            ->setAlt('une image 2 2')
            ->setProduit($produit2);
        $em->persist($image2_2);

        $image2_3 = new Image();
        $image2_3
            ->setUrl('http://image2_3')
            ->setUrlMini('http://bvte54')
            ->setAlt('une image 2 3')
            ->setProduit($produit2);
        $em->persist($image2_3);


        /* ===========================================================
         * = produit 3
         * ===========================================================*/
        // pas de manuel

        $produit3 = new Produit();
        $produit3
            ->setDenomination('vélo')
            ->setCode('2 45 814 445')
            ->setDateCreation(new \DateTime())
            ->setActif(false)
            ->setDescriptif('descriptif 33333')
            ->setManuel(null);      // inutile car valeur par défaut
        $em->persist($produit3);

        // pas d'image


        /* ===========================================================
         * = produit 4
         * ===========================================================*/
        $manuel4 = new Manuel();
        $manuel4
            ->setUrl('http://bbbb')
            ->setSommaire(null);
        $em->persist($manuel4);

        $produit4 = new Produit();
        $produit4
            ->setDenomination('avion')
            ->setCode('8 44 783 712')
            ->setDateCreation(new \DateTime())
            ->setActif(true)
            ->setDescriptif('descriptif 44444')
            ->setManuel($manuel4);
        $em->persist($produit4);

        // pas d'image


        $em->flush();
    }
}
