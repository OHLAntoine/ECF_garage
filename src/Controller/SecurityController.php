<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        if (!$this->getUser()) {

            $error = $authenticationUtils->getLastAuthenticationError();
            $lastEmail = $authenticationUtils->getLastUsername();

            $form = $this->createForm(LoginType::class);
            $form->handleRequest($request);

            return $this->render('security/login.html.twig', [
                'error' => $error,
                'last_email' => $lastEmail,
                'login_form' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('home');
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        
    }
}
