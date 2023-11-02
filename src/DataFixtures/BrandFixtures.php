<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = ['Mercedes-Benz', 'Fiat', 'Renault'];
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

