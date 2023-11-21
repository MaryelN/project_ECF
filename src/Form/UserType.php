<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastname', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Nom',
            'constraints'=> [
                new NotBlank([
                    'message' => 'Veuillez saisir un nom'
                ]),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Veuillez saisir un nom valide',
                    'maxMessage' => 'Veuillez saisir un nom valide'
                ])
                ]
            ])
        ->add('name', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Prénom',
            'constraints'=> [
                new NotBlank([
                    'message' => 'Veuillez saisir un nom'
                ]),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Veuillez saisir un prénom valide',
                    'maxMessage' => 'Veuillez saisir un prénom valide'
                ])
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Adresse'
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
