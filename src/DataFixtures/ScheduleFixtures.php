<?php

namespace App\DataFixtures;

use App\Entity\Schedule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class ScheduleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $schedule1 = new Schedule();
        $schedule1->setDayName('Lundi');
        $schedule1->setOpeningAm(new \DateTime('08:00:00'));
        $schedule1->setClosingAm(new \DateTime('12:00:00'));
        $schedule1->setOpeningPm(new \DateTime('14:00:00'));
        $schedule1->setClosingPm(new \DateTime('18:00:00'));
        
        $manager->persist($schedule1);
        
        $schedule2 = new Schedule();
        $schedule2->setDayName('Mardi');
        $schedule2->setOpeningAm(new \DateTime('08:00:00'));
        $schedule2->setClosingAm(new \DateTime('12:00:00'));
        $schedule2->setOpeningPm(new \DateTime('14:00:00'));
        $schedule2->setClosingPm(new \DateTime('18:00:00'));
        
        $manager->persist($schedule2);

        $schedule3 = new Schedule();
        $schedule3->setDayName('Mercredi');
        $schedule3->setOpeningAm(new \DateTime('08:00:00'));
        $schedule3->setClosingAm(new \DateTime('12:00:00'));
        $schedule3->setOpeningPm(new \DateTime('14:00:00'));
        $schedule3->setClosingPm(new \DateTime('18:00:00'));
        
        $manager->persist($schedule3);

        $schedule4 = new Schedule();
        $schedule4->setDayName('Jeudi');
        $schedule4->setOpeningAm(new \DateTime('08:00:00'));
        $schedule4->setClosingAm(new \DateTime('12:00:00'));
        $schedule4->setOpeningPm(new \DateTime('14:00:00'));
        $schedule4->setClosingPm(new \DateTime('18:00:00'));
        
        $manager->persist($schedule4);

        $schedule5 = new Schedule();
        $schedule5->setDayName('Vendredi');
        $schedule5->setOpeningAm(new \DateTime('08:00:00'));
        $schedule5->setClosingAm(new \DateTime('12:00:00'));
        $schedule5->setOpeningPm(new \DateTime('14:00:00'));
        $schedule5->setClosingPm(new \DateTime('18:00:00'));
        
        $manager->persist($schedule5);

        $schedule6 = new Schedule();
        $schedule6->setDayName('Samedi');
        $schedule6->setOpeningAm(new \DateTime('08:00:00'));
        $schedule6->setClosingAm(new \DateTime('11:00:00'));
        $schedule6->setOpeningPm(new \DateTime('13:00:00'));
        $schedule6->setClosingPm(new \DateTime('17:00:00'));
        
        $manager->persist($schedule6);

        $manager->flush();
    }
}