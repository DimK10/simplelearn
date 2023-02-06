<?php

namespace App\Repository;

use App\Entity\Lesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lesson>
 *
 * @method Lesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lesson[]    findAll()
 * @method Lesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lesson::class);
    }

    public function add(Lesson $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Lesson $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Lesson[] Returns an array of Lesson objects for tutor
     */
    public function getAllLessonsForTutor($tutor, $firstResult, $maxResults): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.tutor = :tutor')
            ->setParameter('tutor', $tutor)
            ->orderBy('l.id', 'ASC')
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Lesson[] Returns an array of Lesson objects for enrolled student
     */
    public function getAllLessonsForEnrolledStudent($studentId, $firstResult, $maxResults): array
    {
        return $this->createQueryBuilder('l')
            ->innerJoin('l.enrolledStudents', 's', 'WITH', 's.id = :studentId')
            ->setParameter('studentId', $studentId)
            ->orderBy('l.id', 'ASC')
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult()
            ;
    }

//    /**
//     * @return Lesson[] Returns an array of Lesson objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Lesson
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
