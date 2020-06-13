<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EleveRepository")
 */
class Eleve {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_eleve;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eleve")
     */
    private $binome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe")
     */
    private $groupe;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe")
     */
    private $classe;

}