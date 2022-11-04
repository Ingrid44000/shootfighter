<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Actualites;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @method getTexte()
 * @method getDoctrine()
 * @method getRepository(string $class)
 */
class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
       // if ($this->getUser()) {
         // return $this->redirectToRoute('app_accueil');
        //}

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/', name: 'app_accueil')]
    public function actualites(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $actualites = $entityManager->getRepository(Actualites::class)->dernieresActualites();


        return $this->render('accueil.html.twig', ['actualites' => $actualites]);
    }



}