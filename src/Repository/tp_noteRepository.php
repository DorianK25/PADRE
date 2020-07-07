<?php

namespace App\Repository;

use App\Entity\tp_note;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method tp_note|null find($id, $lockMode = null, $lockVersion = null)
 * @method tp_note|null findOneBy(array $criteria, array $orderBy = null)
 * @method tp_note[]    findAll()
 * @method tp_note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class tp_noteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, tp_note::class);
    }
}