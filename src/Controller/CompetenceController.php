<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Form\CompetenceType;
use App\Repository\CategoriesCompetenceRepository;
use App\Repository\CompetencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/competences', name: 'competence_')]
class CompetenceController extends AbstractController
{
    // #[Route('/listcom', name: 'one_competence')]
    // public function list(CompetencesRepository $competencesRepository): Response
    // {
    //     $competences = $competencesRepository->findAll();

    //     return $this->render('competence/competence.html.twig', [
    //         'competences' => $competences,
    //     ]);
    // }
  
    #[Route('/listcom/{competences}', name: 'one_competence')]
    public function onelist(Competences $competences): Response
    {
   
        return $this->render('competence/competence.html.twig', [
            'competences' => $competences,
            
        ]);
    }

    // #[Route('/listcat', name: 'list_categorie')]
    // public function index(CategoriesCompetenceRepository $categoriesRepository): Response
    // {
    //     $categories = $categoriesRepository->findAll();


    //     return $this->render('competence/categorie.html.twig', [
    //         'categories' => $categories,
    //     ]);
    // }
    #[Route('/listcat', name: 'list_categorie')]
    public function index(CompetencesRepository $competencesRepository): Response
    {
        $competences = $competencesRepository->findAll();


        return $this->render('competence/cat.html.twig', [
            'competences' => $competences,
        ]);
    }
    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $competence = new Competences();
        $form = $this->createForm(CompetenceType::class, $competence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $em->persist($competence);
            $em->flush();
        }
            return $this->render('competence/ajout.html.twig', [
                
                'competenceForm' => $form
            ]);
    }
    
    #[Route('/edit/{competence}', name: 'edit')]
    public function parametre(Competences $competence,Request $request): Response
    {
        
        $form = $this->createForm(CompetenceType::class, $competence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

           
        }
            return $this->render('competence/parametre.html.twig', [
                
                'competenceForm' => $form
            ]);
    }
}
