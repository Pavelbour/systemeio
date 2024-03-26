<?php

namespace App\Repository;

use App\Entity\TaxNumberValidator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaxNumberValidator>
 *
 * @method TaxNumberValidator|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxNumberValidator|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxNumberValidator[]    findAll()
 * @method TaxNumberValidator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxNumberValidatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxNumberValidator::class);
    }

    //    /**
    //     * @return TaxNumberValidator[] Returns an array of TaxNumberValidator objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TaxNumberValidator
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
