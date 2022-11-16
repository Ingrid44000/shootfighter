<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Actualites;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @method getTexte()
 * @method getDoctrine()
 * @method getRepository(string $class)
 */
class CalendrierController extends AbstractController
{
    #[Route(path: '/calendrier', name: 'app_calendrier')]
    public function calendrier ( ) :Response
    {


        return $this->render('main/calendrier.html.twig');
    }


}