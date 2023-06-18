<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Form\PlanningType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('/edit-planning/{id<\d+>}', name: 'edit-planning')]
    public function edit(Planning $planning, Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {

            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();

            $form = $this->createForm(PlanningType::class, $planning);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->flush();

                return $this->redirectToRoute("home");
            }

            return $this->render('planning/form.html.twig', [
                "planning_form" => $form->createView(),
                "horaires" => $horaires,
                "planning" => $planning,
            ]);
        }
        return $this->redirectToRoute("home");
    }
}
