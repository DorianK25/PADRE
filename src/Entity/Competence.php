<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 */
class Competence {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_competence;


    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_competence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Capacite")
     */
    private $capacite;


    

    /**
     * Get the value of id_competence
     */ 
    public function getId_competence()
    {
        return $this->id_competence;
    }

    

    /**
     * Get the value of nom_competence
     */ 
    public function getNom_competence()
    {
        return $this->nom_competence;
    }

    /**
     * Set the value of nom_competence
     *
     * @return  self
     */ 
    public function setNom_competence($nom_competence)
    {
        $this->nom_competence = $nom_competence;

        return $this;
    }

    /**
     * Get the value of intitule
     */ 
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set the value of intitule
     *
     * @return  self
     */ 
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get the value of capacite
     */ 
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set the value of capacite
     *
     * @return  self
     */ 
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }
}