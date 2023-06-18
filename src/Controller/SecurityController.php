<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Form\LoginType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request, ManagerRegistry $doctrine): Response
    {
        if (!$this->getUser()) {

            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();

            $error = $authenticationUtils->getLastAuthenticationError();
            $lastEmail = $authenticationUtils->getLastUsername();

            $form = $this->createForm(LoginType::class);
            $form->handleRequest($request);

            return $this->render('security/login.html.twig', [
                'error' => $error,
                'last_email' => $lastEmail,
                'login_form' => $form->createView(),
                'horaires' => $horaires,
            ]);
        }
        return $this->redirectToRoute('home');
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        
    }
}
