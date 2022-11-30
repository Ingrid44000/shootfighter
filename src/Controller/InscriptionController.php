<?php

namespace App\Controller;


use App\Entity\Participants;
use App\Form\InscriptionFormType;
use App\Repository\EtatRepository;
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
    , SendMailService $mailTournois,int $id,EtatRepository $etatRepository, TournoisRepository $tournoisRepository) : Response{

        {
            $tournois = $tournoisRepository->find($id); //tournois en question

            $nbParticipants = count($tournois->getParticipants());//nombre de participants au tournois
            $placesRestantes = $tournois->getNbPlacesMax()-$nbParticipants;

            if ($placesRestantes <= 0){
                $this->addFlash("echec", "il n y a plus de place");
                return $this->redirectToRoute('app_tournois');
            }
            $participant = new Participants();


            $form = $this->createForm(InscriptionFormType::class, $participant);
            $form->handleRequest($request);


                if($form->isSubmitted() && $form->isValid()) {



                    $entityManager->persist($participant);
                    $entityManager->flush();


                    // On envoie un mail de confirmation de participation au tournois
                    $mailTournois->send(
                        'no-reply@shootfighter.fr',
                        $participant->getEmail(),
                        'Inscription tournois',
                        'inscriptionTournois',
                        compact('participant'));
                }

            return $this->render('inscription/inscription.html.twig', [
                'inscriptionForm' => $form->createView(),
       ]);
}}}


