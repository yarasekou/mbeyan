<?php

namespace App\Form;

use App\Entity\TypeAcquisition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeAcquisitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom type',
                'required' => true
            ])
            ->add('description', TextType::class, [
                'required' => false
            ])
            ->add('isBienForStructure', CheckboxType::class, [
                'label' => 'Le bien appartient à la structure',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeAcquisition::class,
        ]);
    }
}
