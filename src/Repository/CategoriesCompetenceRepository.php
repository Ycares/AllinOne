<?php

namespace App\Repository;

use App\Entity\CategoriesCompetence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoriesCompetence>
 *
 * @method CategoriesCompetence|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesCompetence|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesCompetence[]    findAll()
 * @method CategoriesCompetence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesCompetenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriesCompetence::class);
    }

//    /**
//     * @return CategoriesCompetence[] Returns an array of CategoriesCompetence objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategoriesCompetence
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
