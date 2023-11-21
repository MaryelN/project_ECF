<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker\Factory;
;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
        ){}

    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setEmail('admin@garage.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin'));
        $admin->setLastname('Parrot');
        $admin->setName('Vincent');
        $admin->setAddress('1 rue du garage');

        $manager->persist($admin);

        $faker = \Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <=5; $usr++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret'));
            $user->setLastname($faker->lastname);
            $user->setName($faker->name);
            $user->setAddress($faker->address);
    
            $manager->persist($user);
        }

        $manager->flush();
    }
}
