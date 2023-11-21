<?php

namespace App\Repository\Car;

use App\Entity\Car\Thumbnail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Thumbnail>
 *
 * @method Thumbnail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thumbnail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thumbnail[]    findAll()
 * @method Thumbnail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThumbnailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thumbnail::class);
    }

}
