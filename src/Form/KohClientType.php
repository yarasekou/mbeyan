<?php

namespace App\Form;

use App\Entity\KohUtilisateur;
use App\Entity\TypeCompte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KohClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'label' => 'Mot de passe',
                'invalid_message' => 'Ce champ doit être identique à la confirmation',
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation mot de passe'],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('telephone')
            ->add('nomUtilisateur')
            ->add('adresse')
            ->add('userProfile', FileType::class, [
                'label' => 'Image profile'
            ])
            ->add('typeCompte', EntityType::class, [
                'class' => TypeCompte::class,
                'label' => 'Type compte',
                'choice_label' => 'name',
                'multiple' => false,
                'placeholder' => '-- Selectionner un type de compte --',
                'required' => true,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => KohUtilisateur::class,
            'allow_extra_fields' => true
        ]);
    }
}
