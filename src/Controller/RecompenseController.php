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

class RecompenseController extends AbstractController
{

    #[Route(path: '/recompenses', name: 'app_recompenses')]
    public function Recompenses (ManagerRegistry $doctrine): Response

    {
        $entityManager = $doctrine->getManager();
        $recompenses = $entityManager->getRepository(Recompenses::class)->afficherRecompenses();

        return $this->render('recompenses.html.twig', ['recompenses'=>$recompenses]);

    }
}