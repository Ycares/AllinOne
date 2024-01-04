<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

     #[Route("/", name:"home")]
    public function index(): Response
    {
        // Vous pouvez passer des données à votre template si nécessaire
        return $this->render('homepage.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/index', name:'index')]
    public function indexUser(){
      return $this->render('list.html.twig');
    }
}
