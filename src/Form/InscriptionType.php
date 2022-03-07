<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomTournoi')
            ->add('NomComplet')
            ->add('NomEquipe')
            ->add('NombreJoueurs')
            ->add('NomJoueur1')
            ->add('NomJoueur2')
            ->add('NomJoueur3')
            ->add('NomJoueur4')
            ->add('NomJoueur5')
            ->add('email')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
