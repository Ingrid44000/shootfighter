<?php

namespace App\Controller;


use App\Entity\Participants;
use App\Entity\Recompenses;
use App\Entity\Tournois;
use App\Entity\User;
use App\Form\InscriptionFormType;
use App\Repository\EtatRepository;
use App\Repository\ParticipantsRepository;
use App\Repository\RecompensesRepository;
use App\Repository\TournoisRepository;
use App\Repository\UserRepository;
use App\Service\SendMailService;
use ContainerAdxux2X\getRecompenseControllerService;
use ContainerAdxux2X\getRecompensesRepositoryService;
use DateTime;
use DateTimeZone;
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

    #[Route(path: '/detail/inscription/{id}', name: 'app_inscription', methods: ['GET','POST'])]
    public function inscription (Request $request, EntityManagerInterface $entityManager
    , SendMailService $mailTournois,int $id, User $use, ParticipantsRepository $participantsRepository, TournoisRepository $tournoisRepository, RecompensesRepository $recompensesRepository) : Response{

        {
            $user = $this->getUser();
            $idUser = $use->getId();
            $tournois = $tournoisRepository->find($id); //tournois en question

            $recompenses = $recompensesRepository->findByTournois($id);


            $nbParticipants = count($tournois->getParticipants());//nombre de participants au tournois
            $placesRestantes = $tournois->getNbPlacesMax()-$nbParticipants;

            $now = new \DateTime('now');
            if ($placesRestantes <= 0 || $now > $tournois->getDateLimiteInscription()){
                $this->addFlash("echec", "les inscriptions sont cloturees");
                return $this->redirectToRoute('app_tournois');
            }

            $participant = new Participants();
            $participant->setUser($user);

            $participant->setTournois($tournois);


            $form = $this->createForm(InscriptionFormType::class, $participant);
            $form->handleRequest($request);


                if($form->isSubmitted() && $form->isValid() && !$participantsRepository->findByUser($id)) {


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
                'placesRestantes' => $placesRestantes,
                'participant' => $participant,
                'user'=> $user,
                'tournois' => $tournois,
                'recompenses' => $recompenses,
                'inscriptionForm' => $form->createView(),
       ]);
    }}
                }



