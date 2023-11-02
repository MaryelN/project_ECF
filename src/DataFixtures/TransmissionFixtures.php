<?php

namespace App\DataFixtures;

use App\Entity\Transmission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class TransmissionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $transmissions = ['Automatique', 'Manuelle', 'Semi-automatique'];
        $counter = 1;

        foreach ($transmissions as $name) {
            $transmission = new Transmission();
            $transmission->setName($name);
            $manager->persist($transmission);

            $this->addReference('tran-' . $counter, $transmission);
            $counter++;
        }

        $manager->flush();
    }
}