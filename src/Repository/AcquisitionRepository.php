<?php

namespace App\Repository;

use App\Entity\Acquisition;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Acquisition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acquisition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acquisition[]    findAll()
 * @method Acquisition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcquisitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acquisition::class);
    }
}