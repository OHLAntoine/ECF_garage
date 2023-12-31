<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/new-service', name: 'new-service')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {

            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();

            $car = new Service();

            $form = $this->createForm(ServiceType::class, $car);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($car);
                $entityManager->flush();

                return $this->redirectToRoute("cars");
            }

            return $this->render('service/form.html.twig', [
                "service_form" => $form->createView(),
                'horaires' => $horaires,
            ]);

        }
        return $this->redirectToRoute("home");
    }

    #[Route('/update-service/{id<\d+>}', name: 'update-service')]
    public function update(Service $service, Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {

            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();

            $form = $this->createForm(ServiceType::class, $service);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->flush();

                return $this->redirectToRoute("home");
            }

            return $this->render('service/form.html.twig', [
                "service_form" => $form->createView(),
                'horaires' => $horaires,
            ]);
        }
        return $this->redirectToRoute("home");
    }

    #[Route('/delete-service/{id<\d+>}', name: "delete-service")]
    public function delete(Service $service, ManagerRegistry $doctrine) : Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {

            $entityManager = $doctrine->getManager();
            $entityManager->remove($service);
            $entityManager->flush();

            return $this->redirectToRoute("home");
        }
        return $this->redirectToRoute("home");
    }
}
