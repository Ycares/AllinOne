<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\ContactEmail;
use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/service', name: 'service_')]
class ServiceController extends AbstractController
{
    public function __construct(
        private readonly MessageGenerator $messageGenerator,
        private readonly ContactEmail $contactEmail

    )
    {}

    #[Route('/contact', name: 'contact')]
    public function contact (Request $request): Response
    {
        $initialData = [
            'nom' => '',
            'prenom' => '',
            'email' => '',
            'message' => ''
        ];
        
        $form = $this->createForm(ContactType::class, $initialData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
             $data = $form->getData();

             try {
             $this->contactEmail->send($data);
             } catch (TransportExceptionInterface $e) {
                $this->addFlash('warnig', "Un propbleme est survenu lors de l'envoie du message");
             }

             dump($data);

            return $this->redirectToRoute('service_contact');
        }

        return $this->render('service/contact.html.twig', [
            'contactForm' => $form
        ]);
    }
}