<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Planning;
use App\Form\AvisType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/new-avis', name: 'new-avis')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        //Récupération du planning d'ouverture
        $repositoryPlanning = $doctrine->getRepository(Planning::class);
        $horaires = $repositoryPlanning->findAll();

        $avis = new Avis();

        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();

            return $this->redirectToRoute("home");
        }
        return $this->render('avis/form.html.twig', [
            'avis_form' => $form->createView(),
            'horaires' => $horaires,
        ]);
    }
}
