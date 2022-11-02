<?php

namespace App\Controller;

use App\Entity\Recompenses;
use App\Entity\Tournois;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TournoisController extends AbstractController
{
    #[Route(path: '/tournois', name: 'app_tournois')]
    public function affichageTournois (ManagerRegistry $doctrine): Response{

        {
            $entityManager = $doctrine->getManager();
            $tournois = $entityManager->getRepository(Tournois::class)->afficherTournois();

            return $this->render('tournois.html.twig', ['tournois'=>$tournois]);

        }
    }

}