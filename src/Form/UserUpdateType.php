<?php

namespace App\Form;


use App\Entity\Competences;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('bio', TextareaType::class)
            ->add('competences', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Competences::class,
                    'choice_label' => 'Competence',
                    
                ]
            ])
            // ->add('photo_profil')
            // ->add('cv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
