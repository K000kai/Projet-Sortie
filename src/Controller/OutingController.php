<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Location;
use App\Entity\Outing;
use App\Entity\Status;
use App\Model\SearchFilterData;
use App\Form\FilterType;
use App\Entity\User;
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

    public function index(OutingRepository $outingRepository, Request $request ): Response
    {

        $searchFilterData = new SearchFilterData();
        $form = $this->createForm(FilterType::class, $searchFilterData);
        $form->handleRequest($request);

        if ($form->get('organisateur')->getData()) {
            $searchFilterData->organisateur = $this->getUser();
        }
        if ($form->get('inscrit')->getData()) {
            $searchFilterData->inscrit = $this->getUser();
        }
        if ($form->get('nonInscrit')->getData()) {
            $searchFilterData->nonInscrit = $this->getUser();
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $outings = $outingRepository->findSearch($searchFilterData, $request);

            $outings =  $outingRepository->findSearch($searchFilterData);
            //dd($searchFilterData);
            return $this->render('main/home.html.twig', [
                'outings' => $outings,
                'form' => $form->createView(),
            ]);
        }

        $outings = $outingRepository->findAll();
        return $this->render('main/home.html.twig', [
            'outings' => $outings,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_outing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager ): Response
    {

        $outing = new Outing();
        $status = new Status();
        $status->setLibelle('Créée');
        $outing->setStatus($status);
        $outing->setCampus($this->getUser()->getCampus());
        $outing->setOrganizer($this->getUser());

        $form = $this->createForm(OutingType::class, $outing, ['action' => $this->generateUrl('app_outing_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($outing);

            $entityManager->flush();

            return $this->redirectToRoute('app_outing_index', [
                'outing' => $outing
            ]);
        }
        return $this->render('outing/new.html.twig', [
            'outing'=> $outing,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_outing_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Outing $outing,OutingRepository $outingRepository): Response
    {
        return $this->render('outing/show.html.twig', [
            'outing' => $outing,

        ]);
    }

    #[Route('/{id}/edit', name: 'app_outing_edit',requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Outing $outing, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OutingType::class, $outing, ['action' => $this->generateUrl('app_outing_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'La sortie a bien été modifiée');
            return $this->redirectToRoute('app_outing_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('outing/edit.html.twig', [
            'outing' => $outing,
            'form' => $form,
        ]);
    }


    #[Route('/register/{id}', name: 'app_user_register', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function addUser(Request $request, Outing $outing, EntityManagerInterface $entityManager,OutingRepository $outingRepository): Response
    {
        $entityManager1 = $entityManager;
        $outing = $entityManager1->getRepository(Outing::class)->find($outing);
        $userRegister = $outingRepository->countUserInOuting();
        if (!$outing) {
            $this->addFlash('danger', 'Sortie introuvable');
            return $this->redirectToRoute('app_outing_index');
        }elseif ($outing->getRegistrationDeadline() < new \DateTime('now')) {
            $this->addFlash('danger', 'La date limite d\'inscription est dépassée');
            return $this->redirectToRoute('app_outing_index');
        }elseif ($outing->getDateTimeStart() < new \DateTime('now')) {
            $this->addFlash('danger', 'La sortie est déja passée');
            return $this->redirectToRoute('app_outing_index');
        } elseif ($userRegister>=$outing->getNbRegistrationMax()){
            $this->addFlash('danger','la sortie est déja complète');
            return $this->redirectToRoute('app_outing_index');
        } else {
            $user = $entityManager1->getRepository(User::class)->find($this->getUser()->getId());
            $outing->addUser($user);
            $entityManager1->persist($outing);
            $entityManager1->flush();
            $this->addFlash('success', 'Vous êtes inscrit à la sortie');
        }
        return $this->render('user/register.html.twig', [
            'controller_name' => 'OutingController',
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

    #[Route('/unsuscribe/{id}', name: 'app_user_unsuscribe', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function unsuscribe(EntityManagerInterface $entityManager, $id, OutingRepository $outingRepository):Response
    {
        $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());




        // Vérifier que l'utilisateur est connecté
        if (!$user) {

            return $this->redirectToRoute('app_login');
        }

        $outing = $entityManager->getRepository(Outing::class)->find($id);

        if (!$outing) {

            $this->addFlash('danger','La sortie n\'existe pas ');
        }
        // Supprimer l'utilisateur de la sortie
        $outing->removeUser($user);
        $entityManager->flush();

        $this->addFlash('success', 'Vous êtes désinscrit de la sortie');
        return $this->redirectToRoute('app_outing_index');

    }
}
