<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher',
                    'class' => 'form-control me-2'
                ]
            ])
            ->add('context', ChoiceType::class, [
                'attr' => [
                    'class' => 'btn btn-outline-light me-2 dropdown-toggle'
                ],
                'choices' => [
                    'SQL' => 'sql',
                    'Symfony' => 'symfony',
                ],
                'label' => false,
            ])
            ->add('send', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-outline-light me-2'
                ]
            ]);
        ;
    }
    public function getBlockPrefix()
    {
        return '';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }
}
