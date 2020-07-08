<?php

namespace App\Repository;

use App\Entity\Acquisition_tp_eleve;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Acquisition_tp_eleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acquisition_tp_eleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acquisition_tp_eleve[]    findAll()
 * @method Acquisition_tp_eleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Acquisition_tp_eleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acquisition_tp_eleve::class);
    }
}