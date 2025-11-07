<?php

namespace App\Repository;

use App\Entity\PokeBall;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PokeBall>
 *
 * @method PokeBall|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokeBall|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokeBall[]    findAll()
 * @method PokeBall[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokeBallRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokeBall::class);
    }

    //    /**
    //     * @return PokeBall[] Returns an array of PokeBall objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PokeBall
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
