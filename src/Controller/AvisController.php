<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Planning;
use App\Form\AvisType;
use App\Repository\AvisRepository;
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

    #[Route('/pending-avis', name: 'pending-avis')]
    public function moderate(ManagerRegistry $doctrine, AvisRepository $repoAvis): Response
    {
        if ($this->getUser()) {
            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();
    
            //Récupération des avis clients à modéré
            $avis = $repoAvis->findAllPending();
    
            return $this->render('avis/index.html.twig', [
                'avis' => $avis,
                'horaires' => $horaires,
            ]);
        }
        return $this->redirectToRoute("home");
    }

    #[Route('/confirm-avis/{id<\d+>}', name: 'confirm-avis')]
    public function confirm(Avis $avis, ManagerRegistry $doctrine): Response
    {
        if ($this->getUser()) {

            $avis->setIsModerate(true);
            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            return $this->redirectToRoute("pending-avis");
        }
        return $this->redirectToRoute("home");
    }
}
