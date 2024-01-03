<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class MessageGenerator{

    private array $messages = [
        "Bonjour, comment allez vous aujord'hui ?",
        "Il est vraiment trés beau en ce moment ! ",
        "Bientot les fetes de noel, c'est toujours un moment magique",
        "Le gras c'est la vie !"
    ];

    public function __construct(
         private readonly LoggerInterface $logger
    )
    {
    }

    public function getMappyMessage(): string
    {
        $index = array_rand($this->messages);
        $message = $this->messages[$index];
        $this->logger->info(sprintf("Message sélectionné: %s", $message));

        return $message;
    }
}