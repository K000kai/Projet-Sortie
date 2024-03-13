<?php

namespace App\Controller;


use App\Entity\Outing;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }



    #[Route('/user/register', name: 'app_user_register')]
    public function register(Request $request, Outing $outing, User $user): Response
    {
        if ($outing->getUsers() !== $this->getUser()) {
            echo "";
            return $this->redirectToRoute('app_outing_index');
        }

        return $this->render('user/register.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

}
