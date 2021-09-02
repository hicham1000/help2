<?php

namespace App\Form;

use App\Entity\Appuser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppuserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',EmailType::class, [
                'attr' => [
                    'placeholder' => 'email',
                    'class' => 'form-control form-control-lg mb-3'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'form-control form-control-lg mb-3'
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'firstname',
                    'class' => 'form-control form-control-lg mb-3'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'lastname',
                    'class' => 'form-control form-control-lg mb-3'
                ]
            ])
            ->add('roles' ,ChoiceType::class, [
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Contributeur' => 'ROLE_CONTRIBUTOR'
                ],
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control form-control-lg mb-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appuser::class,
        ]);
    }
}
