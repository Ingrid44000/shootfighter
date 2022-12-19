<?php

namespace App\Controller;

use App\Entity\Recompenses;
use App\Entity\Tournois;
use App\Repository\TournoisRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TournoisController extends AbstractController
{
    #[Route(path: '/tournois', name: 'app_tournois')]
    public function affichageTournois (ManagerRegistry $doctrine, UserRepository $userRepository): Response
    {

        {

            $entityManager = $doctrine->getManager();
            $tournois = $entityManager->getRepository(Tournois::class)->afficherTournois();

            return $this->render('tournois.html.twig', [ 'tournois' => $tournois]);

        }
    }
    #[Route(path: '/detail/{idTournois}', name: 'app_detail', methods: ['GET', 'POST'])]
    public function afficherDetails( int $idTournois, TournoisRepository $tournoisRepository, ManagerRegistry $doctrine) : Response
    {

        $tournois = $tournoisRepository->find($idTournois);

        $nbParticipants = count($tournois->getParticipants());//nombre de participants au tournois
        $placesRestantes = $tournois->getNbPlacesMax()-$nbParticipants;

        $entityManager = $doctrine->getManager();
        $recompenses = $entityManager->getRepository(Recompenses::class)->afficherRecompenses();

        return $this->render('tournoisDetails.html.twig',[

            'placesRestantes' =>$placesRestantes,
            'recompenses'=>$recompenses,
            'tournois'=>$tournois
        ]);
    }

}