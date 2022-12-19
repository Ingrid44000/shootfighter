<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Tournois;
use App\Form\MonProfilType;
use App\Repository\ParticipantsRepository;
use App\Repository\TournoisRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
#[IsGranted('ROLE_USER')]
class ProfilController extends AbstractController
{
    #[Route('/monprofil/{id}', name: 'app_monProfil')]
    public function monProfil(Request $request, int $id,
                              UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {

        // Ici on appel les parametres du user

        $user = $userRepository->find($id);
        $user = $this->getUser();

        $monProfilForm = $this->createForm(MonProfilType::class, $user);
        $monProfilForm->handleRequest($request);

        if ($monProfilForm->isSubmitted() && $monProfilForm->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $monProfilForm->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Profil modifié avec succès!');

            return $this->redirectToRoute('app_accueil');

        } else if ($monProfilForm->isSubmitted() && !$monProfilForm->isValid()){
            $this->addFlash('error', 'ECHEC de la modification de profil !!!');
        }
        return $this->render('profil/monProfil.html.twig', [
            'user'=>$user,
            'monProfilForm' => $monProfilForm->createView(),
        ]);
    }


    #[Route('/utilisateur/{id}', name: 'app_afficherUtilisateur')]
    public function afficherUtilisateur(int $id, UserRepository $userRepository, ParticipantsRepository $participantsRepository): Response
    {
        $user = $userRepository->find($id);

        $participations = $participantsRepository->findByUser($id);

        return $this->render('profil/afficherUtilisateur.html.twig', [

            'participations'=>$participations,
            'user' => $user
        ]);
    }
    #[Route('/utilisateur/{id}/{idTournois}', name: 'app_desinscrire')]
    public function desinscription(EntityManagerInterface $entityManager, int $id, int $idTournois,
                                   TournoisRepository $tournoisRepository,UserRepository $userRepository,
                                   ParticipantsRepository $participantsRepository): Response
    {

        $user = $userRepository->find($id);
        $tournois = $tournoisRepository->find($idTournois);


        $participation = $participantsRepository->findByOneUser($id, $idTournois);

        $entityManager->remove($participation);
        $entityManager->flush();

        return $this->render('profil/desinscription.html.twig', [
            'tournois'=>$tournois,
            'user'=>$user,
            'participation'=>$participation

        ]);
    }
}
