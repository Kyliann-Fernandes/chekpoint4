<?php

namespace App\Repository;

use App\Entity\SoftSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SoftSkills>
 *
 * @method SoftSkills|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoftSkills|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoftSkills[]    findAll()
 * @method SoftSkills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoftSkillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoftSkills::class);
    }

//    /**
//     * @return SoftSkills[] Returns an array of SoftSkills objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SoftSkills
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
