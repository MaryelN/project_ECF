<?php

namespace App\DataFixtures;

use App\Entity\Car\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CarFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        $yearValue = $faker->numberBetween(2000, 2023);
        $kmValue = $faker->numberBetween(0, 200000);
        $priceValue = $faker->randomFloat(2, 5000, 50000);
        $descriptionValue = $faker->sentence;
        $tranAutomatique = $this->getReference('tran-1');
        $tranManuelle = $this->getReference('tran-2');
        $fuelEssence = $this->getReference('fuel-1');
        $fuelElectric = $this->getReference('fuel-4');
        $brand1 = $this->getReference('brand-1');
        $brand2 = $this->getReference('brand-2');
        $brand3 = $this->getReference('brand-3');
        
        $car1 = new Car();
        $car1->setName('Mercedes-Benz CLA 220');
        $car1->setCarYear($yearValue);
        $car1->setKm($kmValue);
        $car1->setPrice($priceValue);
        $description = "Détails du véhicule
            Catégorie Routière
            Année 2018
            Kilométrage 48321km
            Boîte de vitesses Automatique
            Puissance DIN 381 ch
            Puissance fiscale 26CV
            Énergie Essence
            Couleur Blanc
            Intérieur Autre
            Portières 4
            Sièges 5";
        $car1->setDescription($description);
        $car1->setTransmission($tranAutomatique); 
        $car1->setBrand($brand1); 
        $car1->setFuel($fuelEssence);

        $manager->persist($car1);
        
        $car2 = new Car();
        $car2->setName('Renault Clio Sport');
        $car2->setCarYear($yearValue);
        $car2->setKm($kmValue);
        $car2->setPrice($priceValue);
        $description = "Détails du véhicule
            Catégorie Routière
            Année 2019
            Kilométrage 20189km
            Boîte de vitesses Manuelle
            Puissance DIN 100 ch
            Puissance fiscale 5CV
            Énergie Essence
            Couleur Noir
            Intérieur Autre
            Portières 5
            Numéro VO 388178921
            Sièges 5";
        $car2->setDescription($description);
        $car2->setTransmission($tranManuelle); 
        $car2->setBrand($brand3); 
        $car2->setFuel($fuelEssence);

        $manager->persist($car2);

        $car3 = new Car();
        $car3->setName('Smart Brabus Convertible');
        $car3->setCarYear($yearValue);
        $car3Km = '83250';
        $car3->setKm($car3Km);
        $car3->setPrice('11990');
        $description = "Détails du véhicule
            Catégorie Compacte
            Année 2017
            Kilométrage " .number_format($car3Km, 0, '', ' ') . " km
            Boîte de vitesses Automatique
            Puissance DIN 82 ch
            Puissance fiscale 1CV
            Énergie Électrique
            Couleur Noir
            Intérieur Autre
            Portières 3
            Sièges 2";
        $car3->setDescription($description);
        $car3->setTransmission($tranAutomatique); 
        $car3->setBrand($brand2);
        $car3->setFuel($fuelEssence);

        $manager->persist($car3);

        $car4 = new Car();
        $car4->setName('Fiat 500');
        $car4->setCarYear('2023');
        $car4Km = $kmValue;
        $car4->setKm($car4Km);
        $car4->setPrice($priceValue);
        $description = "Détails du véhicule
            Catégorie Routière
            Année 2023
            Kilométrage " .number_format($car4Km, 0, '', ' ') . " km
            Boîte de vitesses Manuelle
            Puissance DIN 69 ch
            Puissance fiscale 4CV
            Énergie Essence
            Couleur Gris
            Intérieur Autre
            Portières 3
            Sièges 4";
        $car4->setDescription($description);
        $car4->setTransmission($tranManuelle); 
        $car4->setBrand($brand2); 
        $car4->setFuel($fuelElectric);

        $manager->persist($car4);
    
        for ($i = 0; $i < 3; $i++) { 
            $car = new Car();
            $car->setName($faker->word);
            $car->setCarYear($yearValue);
            $car->setKm($kmValue);
            $car->setPrice($priceValue);
            $car->setDescription($descriptionValue);

            $transmission = $this->getReference('tran-'.rand(1,3));
            $car->setTransmission($transmission); 

            $brand = $this->getReference('brand-'.rand(1,3));
            $car->setBrand($brand); 

            $fuel = $this->getReference('fuel-'.rand(1,4));
            $car->setFuel($fuel); 
            
            $manager->persist($car);
        }


        $manager->flush();
    }
        public function getDependencies()
        {
            return [
                TransmissionFixtures::class,
                BrandFixtures::class,
                FuelFixtures::class,
            ];
        }    

}