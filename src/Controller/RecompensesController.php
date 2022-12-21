<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Entity\Recompenses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RecompensesController extends AbstractController
{

    #[Route(path: '/recompenses', name: 'app_recompenses', methods: ['GET', 'POST'])]
    public function Recompenses (ManagerRegistry $doctrine): Response

    {
        $user = $this->getUser();
        $entityManager = $doctrine->getManager();
        $recompenses = $entityManager->getRepository(Recompenses::class)->afficherRecompenses();

        return $this->render('recompenses/recompenses.html.twig', ['user'=>$user,'recompenses'=>$recompenses]);

    }
}