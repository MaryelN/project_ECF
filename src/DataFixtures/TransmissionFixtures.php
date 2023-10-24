<?php

namespace App\DataFixtures;

use App\Entity\Transmission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class TransmissionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $transmission = new Transmission();
        $transmission->setName('Automatique');
        
        $manager->persist($transmission);
        
        $transmission = new Transmission();
        $transmission->setName('Manuelle');

        $manager->persist($transmission);
        
        $transmission = new Transmission();
        $transmission->setName('Semi-automatique');

        $manager->persist($transmission);

        $manager->flush();
    }
}
