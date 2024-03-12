<?php

namespace App\Controller;

use App\Entity\Outing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Date;


/**
 * @method getDoctrine()
 */
class OutingControllerOutdated extends AbstractController
{
    /**
     * @throws \Exception
     */
    #[Route('/outing', name: 'outing')]
    public function createOuting(Request $request): Response
    {
        $outing = new Outing();

            $outing = array(
                'name' => null,
                'dateTimeStart' => new \DateTimeImmutable(),
                'duration' => 120,
                'registrationDeadline' => new \DateTimeImmutable(+10),
                'nbRegistrationMax' => 10,
                'infoOuting' => null
            );

            $outing->setName($outing['name']);
        if ($outing->getName() != null) {
            $form = $this->createFormBuilder($outing)
            ->add('name')
            ->add('dateTimeStart')
            ->add('duration')
            ->add('registrationDeadline')
            ->add('nbRegistrationMax')
            ->add('infoOuting')
            ->getForm();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $outing = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($outing);
                $entityManager->flush();

                return new Response($outing ->getName() .'créée avec l\'id ' . $outing->getId());
        } else {
                return new Response('Veuillez renseigner les informations de la sortie');

        }
    }


       // $form = $this->createFormBuilder($outing);
        return $this->render('outing/create.html.twig', [
       // 'form' => $form->createView(),
    ]);
    }
}