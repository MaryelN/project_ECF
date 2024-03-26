<?php

namespace App\Repository\Car;

use App\Entity\Car\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function paginationQuery($page, $limit, $filters = null)
    {
        $query = $this->createQueryBuilder('c');

        // //on filtre les données
        
        if($filters != null){
            $query->andWhere('c.brand IN (:brands)')
                ->setParameter(':brands', array_values($filters));
        }

        $query->orderBy('c.created_at')
        ->setFirstResult(($page * $limit) - $limit)
        ->setMaxResults($limit)
        ;
        return $query->getQuery()->getResult();
    }

    public function getTotalCars($filters = null )
    {
        $query = $this->createQueryBuilder('c')
            ->select('count(c)');

        if($filters != null){
            $query->andWhere('c.brand IN (:brands)')
                ->setParameter(':brands', array_values($filters));
        }
        
        $query->orderBy('c.created_at');

        return $query->getQuery()->getResult();
    }

    public function findCarsByBrand(string $brand): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.brand = :brand')
            ->setParameter('brand', $brand)
            ->getQuery()
            ->getResult();
    }

    public function findCarsByModel(string $model): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.model = :model')
            ->setParameter('model', $model)
            ->getQuery()
            ->getResult();
    }

}
