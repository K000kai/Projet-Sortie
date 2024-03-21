<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * @method getProfile()
 */
#[Route('/profile')]
class ProfileController extends AbstractController
{   #[isGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_profile_index', methods: ['GET'])]
    public function index(ProfileRepository $profileRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'profiles' => $profileRepository->findAll(),
        ]);
    }
    #[isGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_profile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($profile);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/new.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }
    #[Route('/show', name: 'app_profile_show', methods: ['GET'])]
    public function show(Security $security): Response
    {
        $user = $security->getUser();

        if (!$user) {
            throw new \Exception('Utilisateur non authentifié');
        }

        $profile = $user->getProfile();

        return $this->render('profile/show.html.twig', [
            'profile' => $profile,
            'user' => $user
        ]);
    }



    #[Route('/{id}/edit', name: 'app_profile_edit',requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Profile $profile, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);
        try {
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($profile);
                $entityManager->flush();
                $this->addFlash('success', 'Votre profil a bien été modifié');
                return $this->redirectToRoute('app_outing_index', [], Response::HTTP_SEE_OTHER);
            }
        }catch (\Exception $e){
             $this->addFlash('danger', 'Le pseudo existe déjà, veuillez-en choisir un autre');
        }

        return $this->render('profile/edit.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_profile_delete',requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, Profile $profile, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->request->get('_token'))) {
            $entityManager->remove($profile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/showProfile/{id}', name: 'app_showProfile',requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showProfile(User $user): Response
    {
        $profile = $user->getProfile();
        return $this->render('profile/show.html.twig', [
            'profile' => $profile,
            'user'=>$user
        ]);


    }
}
