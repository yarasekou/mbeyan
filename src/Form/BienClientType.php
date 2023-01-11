<?php

namespace App\Form;

use App\Entity\BienClient;
use App\Entity\DossierMbeyan;
use App\Entity\Region;
use App\Entity\TypeAcquisition;
use App\Entity\TypeBien;
use App\Entity\TypeCompte;
use App\Entity\TypeDocumentPropriete;
use App\Entity\TypeUsageBien;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroDocument', TextType::class, [
                'label' => 'Numero document',
                'required' => true
            ])
            ->add('typeAcquisition', EntityType::class, [
                'class' => TypeAcquisition::class,
                'choice_label' => 'name',
                'label' => 'Type acquisition',
                'mapped' => false,
                'placeholder' => '-- Selectionner un type acquisition --',
                'attr' => ['class' => 'text-uppercase']
            ])
            ->add('typeUsageBien', EntityType::class, [
                'class' => TypeUsageBien::class,
                'label' => 'Type Usage bien',
                'choice_label' => 'name',
                'mapped' => false,
                'placeholder' => '-- Selectionner un type usage --',
                'attr' => ['class' => 'text-uppercase']
            ])
            ->add('ninacad', TextType::class, [
                'required' => false
            ])
            ->add('typeCompte', EntityType::class, [
                'class' => TypeCompte::class,
                'label' => 'Type compte',
                'choice_label' => 'name',
                'mapped' => false,
                'placeholder' => '-- Selectionner un type client --',
                'attr' => ['class' => 'text-uppercase']
            ])
            ->add('typeDocument', EntityType::class, [
                'class' => TypeDocumentPropriete::class,
                'label' => 'Type document',
                'choice_label' => 'name',
                'mapped' => false,
                'placeholder' => '-- Selectionner un type document --',
                'attr' => ['class' => 'text-uppercase']
            ])
            ->add('typeBien', EntityType::class, [
                'class' => TypeBien::class,
                'label' => 'Type de bien',
                'choice_label' => 'name',
                'mapped' => false,
                'placeholder' => '-- Selectionner un type bien --',
                'attr' => ['class' => 'text-uppercase']
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'label' => 'Région',
                'choice_label' => 'name',
                'mapped' => false,
                'placeholder' => '-- Selectionner une région --',
                'attr' => ['class' => 'text-uppercase']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BienClient::class,
        ]);
    }
}
