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
                'attr' => ['class' => 'form-control'],
                'label' => 'Année'
                ])
            ->add('km', IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Km'
                ])
            ->add('price', IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prix'
                ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Description'
                ])
            ->add('transmission', EntityType::class, [
                'class' => Transmission::class, // assuming the FQCN of the Transmission entity
                'choice_label' => 'name', // the property to display in the dropdown
                'attr' => ['class' => 'form-control'],
                'label' => 'Transmission'
            ])
            ->add('fuel', EntityType::class, [
                'class' => Fuel::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label' => 'Carburant'
                ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label' => 'Marque'
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
