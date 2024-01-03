<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


readonly class ContactEmail{

    public function __construct(
        private  MailerInterface $mailer,
        private string           $contactAddress
    )
    {

    }

    /**
     * @throws TransportExecptionInterface
     */
    public function send(array $data): void
{
     $data['mail'] = $data['email'];
     unset($data['email']);

    if(!empty($data["name"])){
        $address = new Address($data["mail"], $data["nom"]);
    }else{
        $address = $data["mail"];
    }

    // $contactAddress = "admin@monosite.fr"; mit dans config/services.yaml

   $mail = (new TemplatedEmail())
   ->from($address)
   ->to($this->contactAddress)
   ->replyTo($data["mail"])
   ->subject($data['sujet'])
   ->textTemplate('email/contact.txt.twig')
   ->context($data);
   
   $this->mailer->send($mail);
}


}
