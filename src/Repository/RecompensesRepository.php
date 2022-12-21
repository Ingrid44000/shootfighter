<?php

namespace App\Repository;

use App\Entity\Recompenses;
use App\Entity\Tournois;
use App\Models\Filtres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recompenses>
 *
 * @method Recompenses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recompenses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recompenses[]    findAll()
 * @method Recompenses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecompensesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recompenses::class);
    }

    public function save(Recompenses $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recompenses $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function afficherRecompenses(): array
    {

        $qb = $this->createQueryBuilder('r');
        $query = $qb->getQuery();
        return $query->execute();
    }

    //Retourne un array des récompenses selon l'id du tournois
    public function findRecompenseByTournois(int $tournois) :array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.tournois = :tournois')
            ->setParameter('tournois', $tournois)
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Recompenses[] Returns an array of Recompenses objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recompenses
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
