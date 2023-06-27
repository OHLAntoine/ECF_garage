<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Planning;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'cars')]
    public function index(ManagerRegistry $doctrine, Request $request, CarRepository $repo): Response
    {
        //Récupération du planning d'ouverture
        $repositoryPlanning = $doctrine->getRepository(Planning::class);
        $horaires = $repositoryPlanning->findAll();

        $search = $request->request->get('search');
        $repository = $doctrine->getRepository(Car::class);
        $cars = $repository->findAll();

        if ($search) {
            $cars = $repo->findBySearch($search);
        }

        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent(), true);
            $minPrice = $data['minPrice'];
            $maxPrice = $data['maxPrice'];
            $minKm = $data['minKm'];
            $maxKm = $data['maxKm'];
            $minYear = $data['minYear'];
            $maxYear = $data['maxYear'];
            
            $cars = $repo->findByRange($minPrice, $maxPrice, $minKm, $maxKm, $minYear, $maxYear);
            return new JsonResponse($cars);
        }

        return $this->render('cars/index.html.twig', [
            "cars" => $cars,
            "horaires" => $horaires,
        ]);
    }

    #[Route('/new-car', name: 'new-car')]
    public function create(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        if ($this->getUser()) {

            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();

            $car = new Car();

            $form = $this->createForm(CarType::class, $car);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // traitement de l'image
                $image = $form->get('image')->getData();
                if ($image) {
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                    try {
                        $image->move(
                            $this->getParameter('uploads'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // error ?
                    }
                    $car->setImage($newFilename);
                }

                $entityManager = $doctrine->getManager();
                $entityManager->persist($car);
                $entityManager->flush();

                return $this->redirectToRoute("cars");
            }

            return $this->render('cars/form.html.twig', [
                "car_form" => $form->createView(),
                "horaires" => $horaires,
            ]);

        }
        return $this->redirectToRoute("cars");
    }

    #[Route('/update-car/{id<\d+>}', name: 'update-car')]
    public function update(Car $car, Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->getUser()) {

            //Récupération du planning d'ouverture
            $repositoryPlanning = $doctrine->getRepository(Planning::class);
            $horaires = $repositoryPlanning->findAll();

            $form = $this->createForm(CarType::class, $car);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->flush();

                return $this->redirectToRoute("cars");
            }

            return $this->render('cars/form.html.twig', [
                "car_form" => $form->createView(),
                "horaires" => $horaires,
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
