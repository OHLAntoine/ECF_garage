<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'cars')]
    public function index(): Response
    {
        return $this->render('cars/index.html.twig');
    }

    #[Route('/cars/new', name: 'cars/new')]
    public function create(Request $request): Response
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($car);
        }

        return $this->render('cars/form.html.twig', [
            "car_form" => $form->createView(),
        ]);
    }
}
