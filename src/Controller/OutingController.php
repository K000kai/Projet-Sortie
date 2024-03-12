<?php

namespace App\Controller;

use App\Repository\OutingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/outing', name: 'outing_')]
class OutingController extends AbstractController
{
    #[Route('', name: 'outing_')]
    public function list (OutingRepository $outingRepository): Response
    {


        return $this->render('outing/index.html.twig', [
            'controller_name' => 'OutingController',
        ]);
    }
}
