<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\CompetenceType;
use App\Form\UserUpdateType;
use App\Repository\CompetencesRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\FileManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly FileManager $fileManager
    ){}

    #[Route('/update/{user}', name: 'update')]
    public function updat(User $user,Request $request, EntityManagerInterface $em): Response
    {
        
        $form = $this->createForm(UserUpdateType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('photo_profil')->getData();

             if($picture != null){
                $filename = $this->fileManager->upload($picture);
                $user->setPhotoProfil($filename);
            }
            $cv = $form->get('cv')->getData();

             if($cv != null){
                $filename = $this->fileManager->download($cv);
                $user->setCv($filename);
            }
            $em->persist($user);
            $em->flush();
           
        }
            return $this->render('user/information.html.twig', [
                
                'userForm' => $form
            ]);
    }
    
    #[Route('/profil/{user}', name: 'profil')]
    public function profil(User $user): Response
    {
        $competences = $user->getCompetences();
        return $this->render('user/profil.html.twig', ['user' => $user, 
        'competences' => $competences
    ]);
    }

    #[Route('/listprofil', name: 'list_profil')]
    public function listprofil(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        
        return $this->render('user/list.html.twig', ['users' => $users]);
    }

    #[Route('/list', name: 'list_users')]
public function listusers(CompetencesRepository $competencesRepository): Response
{
    $competences = $competencesRepository->findAll();
    
    return $this->render('user/test.html.twig', ['competences' => $competences]);
}

}