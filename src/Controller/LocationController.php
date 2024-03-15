<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocationController extends AbstractController
{
    public function addLocation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $location = new Location();
        $locationForm = $this->createForm(LocationType::class, $location);
        $locationForm->handleRequest($request);

        if ($locationForm->isSubmitted() && $locationForm->isValid()) {
            $entityManager->persist($location);
            $entityManager->flush();
        }

        return $this->render('partials/_locationForm.html.twig', [
            'location'=>$location,
        ]);
    }


    #[Route('/locations/{id}', name: 'get_locations_by_city', methods: ['GET'])]
    public function getLocationsByCity(City $city, LocationRepository $locationRepository): JsonResponse
    {
        // Utilisez votre repository de lieux pour récupérer les lieux associés à la ville spécifiée
        $locations = $locationRepository->findBy(['city'=>$city]);

        // Formatez les données pour les renvoyer en tant que réponse JSON
        $data = [];
        foreach ($locations as $location) {
            $data[] = [
                'id' => $location->getId(),
                'name' => $location->getName(),
                // Ajoutez d'autres attributs de lieu si nécessaire
            ];
        }

        // Renvoie les lieux au format JSON
        return new JsonResponse($data);
    }
}
