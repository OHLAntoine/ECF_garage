<?php

namespace App\Controller;

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
        $repository = $doctrine->getRepository(Service::class);
        $services = $repository->findAll();

        return $this->render('home/index.html.twig', [
            "services" => $services,
        ]);
    }
}
