<?php

namespace App\Form;

use App\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [ 
                'attr' => ['class' => 'form-control'],
                'label' => 'Marque de voiture',
                'constraints'=> [
                    new NotBlank([
                        'message'=> 'Veuillez saisir une marque de voiture' 
                    ])
                ]
                ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-3'],
                'label' => 'Ajouter'])    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
