<?php

namespace App\Repository;

use App\Entity\Car;
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

    public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBySearch($search): array
    {
        return $this->createQueryBuilder('car')
            ->andWhere('car.title LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->orderBy('car.circulationDate', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByRange($minPrice, $maxPrice, $minKm, $maxKm, $minYear, $maxYear): array
    {
        return $this->createQueryBuilder('car')
            ->andWhere('car.price BETWEEN :minPrice AND :maxPrice
                    AND car.km BETWEEN :minKm AND :maxKm
                    AND car.circulationDate BETWEEN :minYear AND :maxYear')
            ->setParameter('minPrice', $minPrice)
            ->setParameter('maxPrice', $maxPrice)
            ->setParameter('minKm', $minKm)
            ->setParameter('maxKm', $maxKm)
            ->setParameter('minYear', $minYear)
            ->setParameter('maxYear', $maxYear)
            ->orderBy('car.circulationDate', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }

//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
