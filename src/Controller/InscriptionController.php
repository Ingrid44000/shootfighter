<?php

namespace App\Controller;


use App\Entity\Participants;

use App\Form\InscriptionFormType;
use App\Repository\ParticipantsRepository;
use App\Repository\RecompensesRepository;
use App\Repository\TournoisRepository;
use App\Repository\UserRepository;
use App\Service\SendMailService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;



class InscriptionController extends AbstractController
{
    //créé le formulaire d'inscription à un tournoi

    #[Route(path: '/detail/{idTournois}/{id}/inscription', name: 'app_inscription', methods: ['GET','POST'])]
    public function inscription (Request $request, EntityManagerInterface $entityManager
    , SendMailService $mailTournois,int $idTournois,int $id, UserRepository $userRepository,
                                 ParticipantsRepository $participantsRepository, TournoisRepository $tournoisRepository,
                                 RecompensesRepository $recompensesRepository) : Response{

        {

            $user = $userRepository->find($id); //utilisateur connecté
            $tournois = $tournoisRepository->find($idTournois); //tournois en question

            $goodie = $recompensesRepository->findRecompenseByTournois($idTournois);

            $nbParticipants = count($tournois->getParticipants());//nombre de participants au tournois
            $placesRestantes = $tournois->getNbPlacesMax()-$nbParticipants;

            $now = new \DateTime('now'); //récupère la date du jour
            if ($placesRestantes <= 0 || $now > $tournois->getDateLimiteInscription()){
                $this->addFlash("echec", "les inscriptions sont cloturees");
                return $this->redirectToRoute('app_tournois');
            }

            $participant = new Participants();


            $participant->setUser($user); //on remplit le formulaire avec les données de l'utilisateur

            $participant->setTournois($tournois);//on indique le tournoi concerné par l'inscription


            $form = $this->createForm(InscriptionFormType::class, $participant);
            $form->handleRequest($request);



                if($form->isSubmitted() && $form->isValid() && !$participantsRepository->findByTournois($id, $idTournois)) {

                    $entityManager->persist($participant);
                    $entityManager->flush();


                    // On envoie un mail de confirmation de participation au tournois
                    $mailTournois->sendInscription(
                        'no-reply@shootfighter.fr',
                        $participant->getEmail(),
                        'Inscription tournois',
                        'inscriptionTournois',
                        compact('participant'));
                }

            return $this->render('inscription/inscription.html.twig', [

                'placesRestantes' => $placesRestantes,
                'participant' => $participant,
                'user'=> $user,
                'tournois' => $tournois,
                'goodie'=>$goodie,
                'inscriptionForm' => $form->createView(),
       ]);
    }}
                }



