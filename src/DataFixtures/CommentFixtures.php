<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $comment1 = new Comment();
        $comment1->setLastname('Dupont');
        $comment1->setName('Jean');
        $comment1->setEmail('jeanD@gmail.com');
        $comment1->setRating(5);
        $comment1->setMessage('J\'ai acheté ma dernière voiture chez eux, ils l\'ont entièrement inspectée et m\'ont tout expliqué. Tout est parfait, je n\'ai eu aucun problème. Des gens formidables ! Je recommande ce service à tous ceux qui recherchent la qualité !');
        
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setLastname('Courteaux');
        $comment2->setName('Florian');
        $comment2->setEmail('flo_court@gmail.com');
        $comment2->setRating(5);
        $comment2->setMessage('J\'y fais régulièrement des vidanges, car la voiture a besoin d\'une vidange pour fonctionner correctement. Les employés sont polis et savent vraiment ce qu\'ils font. Je suis également satisfait des prix pratiqués !');

        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setLastname('Leroy');
        $comment3->setName('Jérémy');
        $comment3->setEmail('jeremy@leroy.com');
        $comment3->setRating(5);
        $comment3->setMessage('J\'avais un problème d\'injection de carburant et c\'est pourquoi j\'ai fait appel à ce service ! Ils ont tout réparé et ont même lavé ma voiture gratuitement ! Je suis content d\'y être allé, les gens qui y travaillent m\'ont aussi donné la garantie. Je recommande !');

        $manager->persist($comment3);

        $manager->flush();
    }
}
