<?php

namespace App\Repository;

use App\Entity\Tp;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tp[]    findAll()
 * @method Tp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tp::class);
    }
}