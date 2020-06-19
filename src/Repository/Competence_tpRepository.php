<?php

namespace App\Repository;

use App\Entity\Competence_tp;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Competence_tp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Competence_tp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Competence_tp[]    findAll()
 * @method Competence_tp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Competence_tpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Competence_tp::class);
    }
}