<?php

namespace App\Repository;

use App\Entity\HardSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HardSkills>
 *
 * @method HardSkills|null find($id, $lockMode = null, $lockVersion = null)
 * @method HardSkills|null findOneBy(array $criteria, array $orderBy = null)
 * @method HardSkills[]    findAll()
 * @method HardSkills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HardSkillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HardSkills::class);
    }

//    /**
//     * @return HardSkills[] Returns an array of HardSkills objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HardSkills
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
