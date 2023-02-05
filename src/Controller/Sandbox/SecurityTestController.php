<?php

namespace App\Controller\Sandbox;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
#use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/sandbox/securitytest', name: 'sandbox_securitytest')]
class SecurityTestController extends AbstractController
{
    #[Route('/addusers', name: '_addusers')]
    public function addUsersAction(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user
            ->setLogin('jarod')
            ->setName('Le Caméléon')
            ->setRoles(['ROLE_CLIENT']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'toto');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('parker')
            ->setName('Mlle Parker')
            ->setRoles(['ROLE_SALARIE']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'azerty');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('sidney')
            ->setName('Sidney')
            ->setRoles(['ROLE_SALARIE', 'ROLE_GESTION']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'password');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('raines')
            ->setName('William Raines')
            ->setRoles(['ROLE_DIRIGEANT']);
        $hashedPassword = $passwordHasher->hashPassword($user, '123456');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('angelo')
            ->setName('Angelo')
            ->setRoles(['ROLE_GESTION']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'qwerty');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $em->flush();

        return new Response('<body></body>');
    }

    #[Route('/accessuser', name: '_accessuser')]
    public function accessUserAction(Security $security): Response
    {
        //dump($this->getUser());
        dump($security->getUser());
        dump($security->getUser()->getRoles());
        return $this->render('Sandbox/SecurityTest/access_user.html.twig');
    }

    #[Route('/role1', name: '_role1')]
    #[IsGranted('ROLE_SALARIE')]
    public function role1Action(): Response
    {
        return new Response('<body>IsGranted(\'ROLE_SALARIE\')</body>');
    }
}
