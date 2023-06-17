<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'cars')]
    public function index(ManagerRegistry $doctrine, Request $request, CarRepository $repo): Response
    {
        $search = $request->request->get('search');
        $repository = $doctrine->getRepository(Car::class);
        $cars = $repository->findAll();

        if ($search) {
            $cars = $repo->findBySearch($search);
        }

        return $this->render('cars/index.html.twig', [
            "cars" => $cars,
        ]);
    }

    #[Route('/new-car', name: 'new-car')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->getUser()) {

            $car = new Car();

            $form = $this->createForm(CarType::class, $car);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($car);
                $entityManager->flush();

                return $this->redirectToRoute("cars");
            }

            return $this->render('cars/form.html.twig', [
                "car_form" => $form->createView(),
            ]);

        }
        return $this->redirectToRoute("cars");
    }

    #[Route('/update-car/{id<\d+>}', name: 'update-car')]
    public function update(Car $car, Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->getUser()) {

            $form = $this->createForm(CarType::class, $car);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->flush();

                return $this->redirectToRoute("cars");
            }

            return $this->render('cars/form.html.twig', [
                "car_form" => $form->createView(),
            ]);
        }
        return $this->redirectToRoute("cars");
    }

    #[Route('/delete-car/{id<\d+>}', name: "delete-car")]
    public function delete(Car $car, ManagerRegistry $doctrine) : Response
    {
        if ($this->getUser()) {

            $entityManager = $doctrine->getManager();
            $entityManager->remove($car);
            $entityManager->flush();

            return $this->redirectToRoute("cars");
        }
        return $this->redirectToRoute("cars");
    }
}
