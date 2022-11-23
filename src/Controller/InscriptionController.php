<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Entity\Participants;
use App\Entity\Tournois;
use App\Entity\User;
use App\Form\InscriptionFormType;
use App\Form\RegistrationFormType;
use App\Repository\ParticipantsRepository;
use App\Repository\TournoisRepository;
use App\Service\SendMailService;
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
    //créé le formulaire d'inscription à un tournois

    #[Route(path: '/inscription{id}', name: 'app_inscription')]
    public function inscription (Request $request, EntityManagerInterface $entityManager
    , SendMailService $mailTournois,int $id,TournoisRepository $tournoisRepository, ManagerRegistry $doctrine) : Response{

        {
            $tournois = $tournoisRepository->find($id);
            $entityManager = $doctrine->getManager();

            $participant = new Participants ();

            $form = $this->createForm(InscriptionFormType::class, $participant);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {


                $entityManager->persist($participant);
                $entityManager->flush();
                $this->addFlash('success', 'Inscription réussie!');

                // On envoie un mail de confirmation de participation au tournois
                $mailTournois->send(
                    'no-reply@monsite.net',
                    $participant->getEmail(),
                    'Inscription tournois',
                    'inscriptionTournois',
                    compact('participant'));
            }

            return $this->render('inscription/inscription.html.twig', [
                'inscriptionForm' => $form->createView(),
       ]);
}}}