<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Form\UserUpdateType;
use App\Repository\CompetencesRepository;
use App\Service\FileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly FileManager $fileManager
    ){}
    #[Route('/register', name: 'register')]
   
    public function register(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em): Response{
      $user = new User();
      $form = $this->createForm(UserType::class, $user);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $user->setPassword($hasher->hashPassword($user, $user->getMotDePasse()));
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('user_login');
      }
      return $this->render('user/register.html.twig', [
        'userForm' => $form]);
  }

    #[Route('/login', name:'login')]
    public function login(AuthenticationUtils $auth): Response{

      return $this->render('user/login.html.twig', [
        'last_username'=> $auth->getLastUsername(),
        'error' => $auth->getLastAuthenticationError()
      ]);
       
    }
   

    #[Route('/logout', name:'logout')]
    public function logout():Response{
      throw new \Exception('This code should not be reached, did you forget to add logout path in security.yaml ?');
    }

    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/admin/user/list')]
    public function list(UserRepository $rep) {
        $users = $rep->findAll();
        return $this->render('User/list.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/admin/user/update/{user}')]
    public function update(User $user, Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(UserUpdateType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            if ($user == $this->getUser() && !in_array('ROLE_ADMIN', $user->getRoles())) {
                $roles = $user->getRoles();
                $roles[] = 'ROLE_ADMIN';
                $user->setRoles($roles);
            }

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_user_update', ['user' => $user->getId()]);
        }

        return $this->render('User/update.html.twig', [
            'userForm' => $form,
            'user' => $user
        ]);
    }

    #[Route('/admin/user/delete/{user}')]
    public function delete(User $user, EntityManagerInterface $em) {
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('app_user_list');
    }


    #[Route('/update/{user}', name: 'update')]
    #[IsGranted('editOrDelete','user')]
    public function updat(User $user,Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(UserType::class, $user);

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
    #[Route('/compte/{user}', name: 'compte')]
   

    #[Route('/list', name: 'list_users')]
    public function listusers(CompetencesRepository $competencesRepository): Response
    {
        $competences = $competencesRepository->findAll();
    
        return $this->render('user/test.html.twig', ['competences' => $competences]);
    }


}
