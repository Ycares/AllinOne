<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\UX\Dropzone\Form\DropzoneType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('mot_de_passe', PasswordType::class)
            ->add('bio', TextareaType::class)
            ->add('picture',DropzoneType::class, [
                'label'=> 'Photo de profil',
                'mapped' => false,
                'constraints' =>[
                    new Image(maxWidth:250, maxHeight:250)
                ]
            ])
            // ->add('cv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,        ]);
    }
}
