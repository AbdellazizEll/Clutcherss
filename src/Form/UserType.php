<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class,  $this->getConfiguration("Prénom", "Tapez votre prénom"))
            ->add('lastName', TextareaType::class,  $this->getConfiguration("Nom", "Tapez votre nom de famille"))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Entrez votre email"))
            ->add('picture', UrlType::class,  $this->getConfiguration("Photo de profil", "URL de photo"))
            ->add('password', PasswordType::class, $this->getConfiguration("Password", "Entrez votre mot de passe ... "))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirm Password", "Confirmez votre mot de passe ... "));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
