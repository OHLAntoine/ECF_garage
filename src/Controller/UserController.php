<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/new-user', name: 'new-user')]
    public function new(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {

            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();

            $user = new User($userPasswordHasher);

            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute("home");
            }
            return $this->render('user/form.html.twig', [
                'user_form' => $form->createView(),
                'horaires' => $horaires,
            ]);
        }
        return $this->redirectToRoute('home');
    }
}
