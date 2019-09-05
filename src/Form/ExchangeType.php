<?php

namespace App\Form;

use App\Entity\Exchange;
use App\Entity\Ad;
use App\Entity\Cheese;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ExchangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cheeseGiven', EntityType::class, [
            'placeholder' => 'Choisissez un fromage',
            'class' => Cheese::class,
            'choice_label' => 'name'
            ])
            ->add('message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exchange::class,
        ]);
    }
}
