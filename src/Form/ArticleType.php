<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	/** @var Article|null $article */
    	$article = $options['data'] ?? null;
    	$isEdit = $article && $article->getId();

        $builder
            ->add('title', TextType::class)
            ->add('content', TextType::class)
        ;

        $imageConstraints = [
            new Image([
                'maxSize' => '2M'
            ])
        ];

        if (!$isEdit || !$article->getImageFilename())
        {
        	$imageConstraints[] = new NotNull([
        		'message' => 'Please upload an image',
	        ]);
        }

        $builder
            ->add('imageFile', FileType::class, [
	            	'mapped' => false,
	                'required' => false,
	                'constraints' => $imageConstraints
	            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
