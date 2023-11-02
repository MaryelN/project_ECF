<?php

namespace App\DataFixtures;

use App\Entity\Car;
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

        $car1 = new Car();
        $car1->setName('Mercedes-Benz CLA 220');
        $car1->setCarYear($yearValue);
        $car1->setKm('48321');
        $car1->setPrice($priceValue);
        $description = "Détails du véhicule
        <ul>
            <li>Catégorie Routière</li>
            <li>Année 2018</li>
            <li>Kilométrage 48321km</li>
            <li>Boîte de vitesses Automatique</li>
            <li>Puissance DIN 381 ch</li>
            <li>Puissance fiscale 26CV</li>
            <li>Énergie Essence</li>
            <li>Couleur Blanc</li>
            <li>Intérieur Autre</li>
            <li>Portières 4</li>
            <li>Sièges 5</li>
        </ul>";

        $car1->setDescription($description);
        $car1->setTransmission($tranAutomatique); 
        $car1->setBrand($brand1); 
        $car1->setFuel($fuelEssence);

        $manager->persist($car1);
        
        $car2 = new Car();
        $car2->setName('Renault Clio Sport');
        $car2->setCarYear('2019');
        $car2->setKm('20189');
        $car2->setPrice('18980');
        $description = "Détails du véhicule
        <ul>
            <li>Catégorie Routière</li>
            <li>Année 2019</li>
            <li>Kilométrage 20189km</li>
            <li>Boîte de vitesses Manuelle</li>
            <li>Puissance DIN 100 ch</li>
            <li>Puissance fiscale 5CV</li>
            <li>Énergie Essence</li>
            <li>Couleur Noir</li>
            <li>Intérieur Autre</li>
            <li>Portières 5</li>
            <li>Numéro VO 388178921</li>
            <li>Sièges 5</li>
        </ul>";
        $car2->setDescription($description);
        $car2->setTransmission($tranManuelle); 
        $car2->setBrand($brand3); 
        $car2->setFuel($fuelEssence);

        $manager->persist($car2);

        $car3 = new Car();
        $car3->setName('Smart Brabus Convertible');
        $car3->setCarYear('2017');
        $car3Km = '83250';
        $car3->setKm($car3Km);
        $car3->setPrice('11990');
        $description = "Détails du véhicule
        <ul>
            <li>Catégorie Compacte</li>
            <li>Année 2017</li>
            <li>Kilométrage " .number_format($car3Km, 0, '', ' ') . " km</li>
            <li>Boîte de vitesses Automatique</li>
            <li>Puissance DIN 82 ch</li>
            <li>Puissance fiscale 1CV</li>
            <li>Énergie Électrique</li>
            <li>Couleur Noir</li>
            <li>Intérieur Autre</li>
            <li>Portières 3</li>
            <li>Sièges 2</li>
        </ul>";
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
        <ul>
            <li>Catégorie Routière</li>
            <li>Année 2023</li>
            <li>Kilométrage " .number_format($car4Km, 0, '', ' ') . " km</li>
            <li>Boîte de vitesses Manuelle</li>
            <li>Puissance DIN 69 ch</li>
            <li>Puissance fiscale 4CV</li>
            <li>Énergie Essence</li>
            <li>Couleur Gris</li>
            <li>Intérieur Autre</li>
            <li>Portières 3</li>
            <li>Sièges 4</li>
        </ul>";
        $car4->setDescription($description);
        $car4->setTransmission($tranManuelle); 
        $car4->setBrand($brand2); 
        $car4->setFuel($fuelElectric);

        $manager->persist($car4);
    

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