<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Competence_tpRepository")
 */
class Competence_tp {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_competence_tp;


    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tp")
     */
    private $tp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Capacite")
     */
    private $capacite;

    /**
     * @ORM\Column(type="integer")
     */
    private $barem_capacite;


    
}