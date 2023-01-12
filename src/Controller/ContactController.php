<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use App\Service\SendMailService;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        SendMailService $mailService
    ): \Symfony\Component\HttpFoundation\Response
    {
        $user = $this->getUser();
        $contact = new Contact();

        //remplir champ formulaire par l email de l'utilisateur connecté
        if ($this->getUser()) {
            $contact
                ->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactFormType::class, $contact);

        //formulaire de contact
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            //Email
            $mailService->sendEmail(
                $contact->getEmail(),
                $contact->getSujet(),
                'emails/contact.html.twig',
                ['contact' => $contact]
            );

            $this->addFlash(
                'success',
                'Votre demande a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_accueil');
        } else {
            $this->addFlash(
                'danger',
                $form->getErrors()
            );
        }

        return $this->render('contact/contact.html.twig', [
            'user'=>$user,
            'contactForm' => $form->createView(),
        ]);
    }
}

