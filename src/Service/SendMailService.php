<?php
namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;


class SendMailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(
        string $from,
        string $to,
        string $subject,
        array $context
    ): void
    {
        //On crée le mail
        $mail = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate("emails/emailregister.html.twig")
            ->context($context);

        // On envoie le mail
        $this->mailer->send($mail);
    }
    //On crée le mail d'inscription aux tournois
        public function sendInscription(
            string $from,
            string $to,
            string $subject,
            array $context
        ): void
        {

            $mailTournois = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate("emails/inscriptionTournois.html.twig")
            ->context($context);

    // On envoie le mail
$this->mailer->send($mailTournois);
}

    public function sendEmail(
        string $from,
        string $subject,
        string $htmlTemplate,
        array $context,
        string $to = 'admin@shootfighter.fr'
    ): void {
        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate($htmlTemplate)
            ->context($context);

        $this->mailer->send($email);
    }

}