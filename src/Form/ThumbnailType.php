<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use App\Entity\Car\Car;
use App\Entity\Car\Thumbnail;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ThumbnailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('imageName')
            ->add('imageName', VichImageType::class, [
                'label' => 'Thumbnail Image',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,  // Include this line if you need image_uri
             // Include this line if you use ImagineBundle
            ])
            ->add('Car', EntityType::class, [
                'class' => Car::class, 
                'choice_label' => 'name', 
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Thumbnail::class,
        ]);
    }
}
