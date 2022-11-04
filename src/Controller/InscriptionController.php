<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\User;
use App\Form\InscriptionFormType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class InscriptionController extends AbstractController
{
    #[Route(path: '/inscription', name: 'app_inscription')]
    public function inscription (Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response{

        {
            $participant = new Participants ();
            $form = $this->createForm(InscriptionFormType::class, $participant);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager->persist($participant);
                $entityManager->flush();
                // do anything else you need here, like send an email


        }
            return $this->render('inscription.html.twig', [
                'inscriptionForm' => $form->createView()]);
}}}