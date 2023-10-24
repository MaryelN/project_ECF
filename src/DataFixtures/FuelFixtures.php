<?php

namespace App\DataFixtures;

use App\Entity\Fuel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class FuelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fuel1 = new Fuel();
        $fuel1->setName('Essence');

        $manager->persist($fuel1);

        $fuel2 = new Fuel();
        $fuel2->setName('Diesel');

        $manager->persist($fuel2);
        
        $fuel3 = new Fuel();
        $fuel3->setName('Hybride');

        $manager->persist($fuel3);
        
        $fuel4 = new Fuel();
        $fuel4->setName('Electrique');

        $manager->persist($fuel4);

        $manager->flush();
    }
}
