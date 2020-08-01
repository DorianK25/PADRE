<?php

namespace App\Repository;

use App\Entity\Mot_de_passe_admin;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Mot_de_passe_admin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mot_de_passe_admin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mot_de_passe_admin[]    findAll()
 * @method Mot_de_passe_admin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Mot_de_passe_adminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mot_de_passe_admin::class);
    }
}