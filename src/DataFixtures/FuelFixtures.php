<?php

namespace App\DataFixtures;

use App\Entity\Car\Fuel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class FuelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fuels = ['Essence', 'Diesel', 'Hybride', 'Electrique'];
        $counter = 1;

        foreach ($fuels as $name) {
            $fuel = new Fuel();
            $fuel->setName($name);
            $manager->persist($fuel);

            $this->addReference('fuel-' . $counter, $fuel);
            $counter++;
        }

        $manager->flush();
    }
}
