<?php

namespace App\Form;

use App\Entity\Cercle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CercleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du cercle'
            ])
            ->add('latitude')
            ->add('longitude')
            ->add('region', EntityType::class, [
                'class' => 'App\Entity\Region',
                'choice_label' => 'name',
                'multiple' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cercle::class,
        ]);
    }
}
