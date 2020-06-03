<?php

namespace App\Repository;

use App\Entity\Professeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Professeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Professeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Professeur[]    findAll()
 * @method Professeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfesseurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Professeur::class);
    }
}