<?php

namespace App\Mail;

use App\Entity\ProfessorUser;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class Mail
{


    public function __construct(private MailerInterface $mailer, private string $adminEmail)
    {

    }
    public function sendMail(ProfessorUser $prof): void
    {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($prof->getEmail())
            ->subject("Bienvenue " . $prof->getFirstname() . " ! Merci d'avoir rejoins Witopi !")
            ->text("Mille mercis vous êtes un incroyable BG galactique");

        $this->mailer->send($email);

    }

}
