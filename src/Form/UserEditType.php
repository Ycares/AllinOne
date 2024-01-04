<?php

namespace App\Form;

use App\Entity\Competences;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\File;
use Symfony\UX\Dropzone\Form\DropzoneType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class)
        ->add('prenom', TextType::class)
        ->add('email', EmailType::class)
        ->add('bio', TextareaType::class)
        ->add('salaire', NumberType::class,)
        ->add('metier', TextType::class, )
        ->add('competences', CollectionType::class, [
            'entry_type' => EntityType::class,
            'entry_options' => [
                'class' => Competences::class,
                'choice_label' => 'Competence',
                
            ]
        ])
        ->add('photo_profil',DropzoneType::class, [
            'label'=> 'Photo de profil',
            'mapped' => false,
            'constraints' =>[
                new Image(maxWidth:250, maxHeight:250)
            ]
        ])
        ->add('cv', DropzoneType::class, [
            'mapped' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1024k', // Taille maximale du fichier (1 Mo)
                    'mimeTypes' => [
                        'application/pdf', // Autoriser uniquement les fichiers PDF
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger un fichier PDF valide',
                ])
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
