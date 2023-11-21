<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $service1 = new Service();
        $service1->setName('Entretien préventif des véhicules');
        $service1->setPrice(10.00);
        $service1->setDescription('Nous effectuerons le check-up de la voiture et trouverons pour vous les problèmes liés au système de refroidissement, au moteur, à la direction et à la suspension ! Pas besoin d\'être un expert pour faire l\'entretien de sa voiture !');

        $manager->persist($service1);
        
        $service2 = new Service();
        $service2->setName('Réparation et entretien généraux de l\'automobile');
        $service2->setPrice(20.00);
        $service2->setDescription('Nous effectuerons le check-up de la voiture et trouverons pour vous les problèmes liés au système de refroidissement, au moteur, à la direction et à la suspension ! Pas besoin d\'être un expert pour faire l\'entretien de sa voiture !');

        $manager->persist($service2);
        
        $service3 = new Service();
        $service3->setName('Réparation de la transmission');
        $service3->setPrice(30.00);
        $service3->setDescription('Nous sommes l\'un des experts les plus fiables en matière de diagnostic, de service et d\'entretien des transmissions. Nous effectuons tous les travaux et nous les garantissons!');

        $manager->persist($service3);
        
        $service4 = new Service();
        $service4->setName('Diagnostic électrique');
        $service4->setPrice(15.00);
        $service4->setDescription('La plupart des voitures d\'aujourd\'hui ont des systèmes électriques complexes. Nous pouvons vous fournir un service de routine, et dès que vous rencontrez des problèmes électriques, notre personnel vous assiste');

        $manager->persist($service4);
        
        $service5 = new Service();
        $service5->setName('Travaux de direction et de suspension');
        $service5->setPrice(15.00);
        $service5->setDescription('Description');

        $manager->persist($service5);
        
        $service6 = new Service();
        $service6->setName('Service recommandé par le fabricant');
        $service6->setPrice(15.00);
        $service6->setDescription('Description');

        $manager->persist($service6);
        
        $service7 = new Service();
        $service7->setName('Réparation et remplacement des freins');
        $service7->setPrice(15.00);
        $service7->setDescription('Description');

        $manager->persist($service7);
        
        $service8 = new Service();
        $service8->setName('Réparation de l\'air conditionné');
        $service8->setPrice(15.00);
        $service8->setDescription('Description');

        $manager->persist($service8);

        $service9 = new Service();
        $service9->setName('Réparation et remplacement des pneus');
        $service9->setPrice(15.00);
        $service9->setDescription('Description');

        $manager->persist($service9);

        $service10 = new Service();
        $service10->setName('Réparation du système d\'alimentation en carburant');
        $service10->setPrice(15.00);
        $service10->setDescription('Description');

        $manager->persist($service10);

        $service11 = new Service();
        $service11->setName('Réparation du système d\'échappement');
        $service11->setPrice(15.00);
        $service11->setDescription('Description');

        $manager->persist($service11);

        $service12 = new Service();
        $service12->setName('Entretien du système de refroidissement du moteur');
        $service12->setPrice(15.00);
        $service12->setDescription('Description');

        $manager->persist($service12);

        $service13 = new Service();
        $service13->setName('Réparation du démarrage et de la charge');
        $service13->setPrice(15.00);
        $service13->setDescription('Description');

        $manager->persist($service13);

        $service14 = new Service();
        $service14->setName('Alignement des roues');
        $service14->setPrice(15.00);
        $service14->setDescription('Description');

        $manager->persist($service14);

        $service15 = new Service();
        $service15->setName('Contrôle des émissions de l\'État');
        $service15->setPrice(20.00);
        $service15->setDescription('Description');

        $manager->persist($service15);

        $service16 = new Service();
        $service16->setName('Réparation des émissions');
        $service16->setPrice(15.00);
        $service16->setDescription('Description');

        $manager->persist($service16);

        $service17 = new Service();
        $service17->setName('Mise au point');
        $service17->setPrice(15.00);
        $service17->setDescription('Description');

        $manager->persist($service17);

        $service18 = new Service();
        $service18->setName('Vidange d\'huile');
        $service18->setPrice(15.00);
        $service18->setDescription('Description');

        $manager->persist($service18);

        $service19 = new Service();
        $service19->setName('Remise en état des freins / Service de freinage');
        $service19->setPrice(15.00);
        $service19->setDescription('Description');

        $manager->persist($service19);

        $service20 = new Service();
        $service20->setName('Rinçage et réparation du système de refroidissement du moteur');
        $service20->setPrice(15.00);
        $service20->setDescription('Description');

        $manager->persist($service20);

        $faker = \Faker\Factory::create('fr_FR');

        for($srv = 1; $srv <=3; $srv++){

        $service = new Service();
        $service->setName($faker->name);
        $service->setPrice($faker->numberBetween(10, 100));
        $service->setDescription($faker->text); 

        $manager->persist($service);
        }

        $manager->flush();
    }
}
