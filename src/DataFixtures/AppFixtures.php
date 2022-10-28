<?php

namespace App\DataFixtures;

use App\Entity\Actualites;
use App\Entity\Admin;
use App\Entity\Participants;
use App\Entity\Recompenses;
use App\Entity\Tournois;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        //creation d'actualites
        $actualite = new Actualites();
        $actualite->setNom('sortie jeu video 2023');
        $actualite->setTexte('Le jeu va sortir en 2023');
        $manager->persist($actualite);

        // Creation admin
        $admin = new Admin();
        $admin->setUsername('administrateur');
        $admin->setPassword('administrateur');
        $admin->setRoles((array)'ROLE_ADMIN');
        $manager->persist($admin);

        //Creation participants
        $participant = new Participants();
        $participant->setPseudo('darkness01');
        $participant->setNom('Tessier');
        $participant->setPrenom('Marina');
        $participant->setEmail('ma.tessier@gmail.com');
        $participant->setMotdepasse('toto44');
        $participant->setAdressePostale('15 rue Joachim du Bellay');
        $participant->setCodePostal('44000');
        $participant->setVille('Nantes');
        $participant->setPays('France');
        $manager->persist($participant);

        //Creation récompenses
        $recompense = new Recompenses();
        $recompense->setNom('Tshirt');
        $recompense->setDescription('Tshirt avec image Shootfighter');
        $recompense->setImageName('Tshirt.jpg');
        $manager->persist($recompense);

        //Creation tournois
        $tournois = new Tournois();
        $tournois->setNom('Tournois de Paris');
        $dateDebut = new \DateTime('2023-01-17 21:00:00');
        $tournois->setDate($dateDebut);
        $dateLimite = new \DateTime ('2023-01-05 17:00:00');
        $tournois->setDateLimiteInscription($dateLimite);
        $tournois->setNbPlacesMax(150);
        $manager->persist($tournois);

        $manager->flush();
    }
}
