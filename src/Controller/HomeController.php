<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Entity\Service;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        //Récupération des services
        $repositoryService = $doctrine->getRepository(Service::class);
        $services = $repositoryService->findAll();

        //Récupération du planning d'ouverture
        $repositoryPlanning = $doctrine->getRepository(Planning::class);
        $horaires = $repositoryPlanning->findAll();

        return $this->render('home/index.html.twig', [
            "services" => $services,
            "horaires" => $horaires,
        ]);
    }
}
