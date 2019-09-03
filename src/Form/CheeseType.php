<?php

namespace App\Form;

use App\Entity\Cheese;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheeseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area')
            ->add('name')
            ->add('frenchWikipedia')
            ->add('englishWikipedia')
            ->add('image')
            ->add('milk')
            ->add('geoShape')
            ->add('geoPoint')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cheese::class,
        ]);
    }
}
