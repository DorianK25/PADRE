<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfesseurRepository")
 */
class Professeur {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;


    public function __construct()
    {
        $this->Penom = "dorian";
        $this->Nom = "keurinck";
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Prenom
     */ 
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * Get the value of Nom
     */ 
    public function getNom()
    {
        return $this->Nom;
    }

    public function getNomComplet(){

        return $this->Nom." ".$this->Prenom;
    }
}