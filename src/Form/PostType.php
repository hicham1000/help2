<?php

namespace App\Form;

use App\Entity\Context;
use App\Entity\Post;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre de l\'article',
                    'class' => 'form-control form-control-lg mb-3'
                ]
            ])
            ->add('content',  CKEditorType::class, [
                'attr' => [
                    'class' => 'form-control mb-3', 
                    'toolbar' => 'basic'
                ]
            ])
            
            ->add('obsoleted_date', DateType::class, [
                'attr' => [
                    'class' => 'd-none'
                ]
            ])
            ->add('keyword', TextType::class, [
                'attr' => [
                    'placeholder' => 'Mots clés',
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('context', EntityType::class, [
                'class' => Context::class,
                'choice_label' => 'label'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
