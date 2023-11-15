<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\Fuel;
use App\Entity\Transmission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom'
                ])
            ->add('car_year', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1900,
                    'max' => 2023
                ],
                'label' => 'Année',
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Veuillez saisir une année'
                    ]),
                    new Length([
                        'min' => 4,
                        'max' => 4,
                        'minMessage' => 'Veuillez saisir une année valide',
                        'maxMessage' => 'Veuillez saisir une année valide'
                    ])
                    ],
                ])
            ->add('km', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 10000,
                    'max' => 300000
                ],
                'label' => 'Kilometrage',
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Veuillez saisir un kilometrage'
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 6,
                        'minMessage' => 'Veuillez saisir un kilometrage valide',
                        'maxMessage' => 'Veuillez saisir un kilometrage valide'
                    ])
                    ]
                ])  
            ->add('price', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1000,
                    'max' => 100000
                ],
                'label' => 'Prix',
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Veuillez saisir un prix'
                    ]),
                    new Length([
                        'min' => 4,
                        'max' => 6,
                        'minMessage' => 'Veuillez saisir un prix valide',
                        'maxMessage' => 'Veuillez saisir un prix valide'
                    ])
                    ]
                ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1000,
                    'max' => 100000
                ],
                'label' => 'Description',
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Veuillez saisir une description'
                    ]),
                    new Length([
                        'min' => 10,
                        'max' => 255,
                        'minMessage' => 'Veuillez saisir plus de 10 caractères',
                        'maxMessage' => 'Veuillez saisir moins de 255 caractères'
                    ])
                ]
                
                ])
            ->add('transmission', EntityType::class, [
                'class' => Transmission::class, 
                'choice_label' => 'name', 
                'attr' => ['class' => 'form-control'],
                'label' => 'Transmission',
                'required' => true,
                'placeholder' => 'Choisir une transmission'
            ])
            ->add('fuel', EntityType::class, [
                'class' => Fuel::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label' => 'Carburant',
                'required' => true,
                'placeholder' => 'Choisir un carburant'
                ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label' => 'Marque',
                'required' => true,
                'placeholder' => 'Choisir une marque'
                ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary m-3'],
                'label' => 'Sauvegarder'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
