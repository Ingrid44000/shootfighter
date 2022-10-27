<?php

namespace App\Controller;

use App\Entity\Tournois;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TournoisController extends AbstractController
{
    #[Route(path: '/tournois', name: 'app_tournois')]
    public function affichageTournois (Tournois $tournois): Response{

    }

}