<?php

namespace App\DataFixtures;

use App\Entity\Car\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = ['Mercedes-Benz', 'Fiat', 'Renault', 'Peugeot', 'Volkswagen', 'Audi', 'BMW', 'Ford', 'Opel', 'Toyota', 'Citroen', 'Nissan', 'Hyundai', 'Kia', 'Seat', 'Skoda', 'Volvo', 'Mazda', 'Honda', 'Mitsubishi', 'Suzuki', 'Dacia', 'Lexus', 'Jeep', 'Land Rover', 'Subaru'];
        $counter = 1;

        foreach ($brands as $name) {
            $brand = new Brand();
            $brand->setName($name);
            $manager->persist($brand);

            $this->addReference('brand-' . $counter, $brand);
            $counter++;
        }

        $manager->flush();
    }
}

