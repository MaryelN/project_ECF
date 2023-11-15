<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 5,
                'max' => 100
            ],
            'label' => 'E-mail',
            'constraints'=> [
                new NotBlank([
                    'message' => 'Veuillez saisir un e-mail'
                ]),
                new Length([
                    'min' => 5,
                    'max' => 100,
                    'minMessage' => 'Veuillez saisir un e-mail valide',
                    'maxMessage' => 'Veuillez saisir un e-mail valide'
                ])
                ]
            ])
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
            ])
        ->add('RGPDConsent', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter nos conditions.',
                ]),
            ],
            'label' => 'En cochant cette case, vous acceptez nos conditions générales d\'utilisation'
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                'class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}