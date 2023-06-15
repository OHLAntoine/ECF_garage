<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'cars')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Car::class);
        $cars = $repository->findAll();
        return $this->render('cars/index.html.twig', [
            "cars" => $cars,
        ]);
    }

    #[Route('/new-car', name: 'new-car')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            // return $this->redirectToRoute("home");
        }

        return $this->render('cars/form.html.twig', [
            "car_form" => $form->createView(),
        ]);
    }
}
