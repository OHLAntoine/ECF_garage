<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact-us', name: 'contact-us')]
    public function contact(ManagerRegistry $doctrine, Request $request): Response
    {
        //Récupération du planning d'ouverture
        $repositoryPlanning = $doctrine->getRepository(Planning::class);
        $horaires = $repositoryPlanning->findAll();

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Envoi de mail à venir
        }

        return $this->render('contact/form.html.twig', [
            "horaires" => $horaires,
            "contact_form" => $form->createView(),
        ]);
    }
}
