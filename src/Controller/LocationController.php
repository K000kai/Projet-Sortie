<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
