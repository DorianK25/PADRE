<?php

namespace App\Repository;

use App\Entity\Planning_eleve;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Planning_eleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planning_eleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planning_eleve[]    findAll()
 * @method Planning_eleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Planning_eleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planning_eleve::class);
    }
}