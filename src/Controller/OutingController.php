<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Location;
use App\Entity\Outing;
use App\Entity\Status;
use App\Form\OutingForm;
use App\Form\OutingType;
use App\Repository\OutingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[isGranted('ROLE_USER')]
class OutingController extends AbstractController
{
    #[Route('/', name: 'app_outing_index', methods: ['GET'])]
    public function index(OutingRepository $outingRepository): Response
    {

        $outings =  $outingRepository->findAll();
        return $this->render('main/home.html.twig', [
            'outings' => $outings,

        ]);
    }

    #[Route('/new', name: 'app_outing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $outing = new Outing();
        $status=new Status();
        $status->setLibelle('Créée');
        $outing->setStatus($status);

        $form = $this->createForm(OutingType::class, $outing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($outing);
            $entityManager->flush();

            return $this->redirectToRoute('app_outing_index', [
                'outing'=> $outing
            ]);
        }
        return $this->render('outing/new.html.twig', [
            'outing'=> $outing,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_outing_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Outing $outing): Response
    {
        return $this->render('outing/show.html.twig', [
            'outing' => $outing,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_outing_edit',requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Outing $outing, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OutingType::class, $outing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_outing_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('outing/edit.html.twig', [
            'outing' => $outing,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_outing_delete',requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, Outing $outing, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outing->getId(), $request->request->get('_token'))) {
            $entityManager->remove($outing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_outing_index', [], Response::HTTP_SEE_OTHER);
    }
}
