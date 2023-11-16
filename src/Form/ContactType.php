<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom'
                ])
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prénom'
                ])
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
            ->add('subject', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Sujet'
                ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 10,
                    'max'=> 255
                ],
                'label' => 'Message',
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Veuillez saisir un message'
                    ]),
                    new Length([
                        'min' => 10,
                        'max' => 255,
                        'minMessage' => 'Veuillez saisir un message valide',
                        'maxMessage' => 'Veuillez saisir un message valide'
                    ])
                    ]
                ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary m-3'],
                'label' => 'Envoyer'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
