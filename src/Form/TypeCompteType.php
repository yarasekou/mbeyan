<?php

namespace App\Form;

use App\Entity\TypeCompte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeCompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du type'
            ])
            ->add('description')
            ->add('hasManyUser', null, [
                'label' => 'Compte à plusieurs utilisateurs'
            ])
            ->add('isStructure', null, [
                'label' => 'Compte pour structure'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeCompte::class,
        ]);
    }
}
