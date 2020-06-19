<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapaciteRepository")
 */
class Capacite {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_capacite;




    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_Capacite;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intutule;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competence")
     */
    private $competence;




    /**
     * Get the value of competence
     */ 
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Set the value of competence
     *
     * @return  self
     */ 
    public function setCompetence($competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get the value of intutule
     */ 
    public function getIntutule()
    {
        return $this->intutule;
    }

    /**
     * Set the value of intutule
     *
     * @return  self
     */ 
    public function setIntutule($intutule)
    {
        $this->intutule = $intutule;

        return $this;
    }

    /**
     * Get the value of nom_Capacite
     */ 
    public function getNom_Capacite()
    {
        return $this->nom_Capacite;
    }

    /**
     * Set the value of nom_Capacite
     *
     * @return  self
     */ 
    public function setNom_Capacite($nom_Capacite)
    {
        $this->nom_Capacite = $nom_Capacite;

        return $this;
    }

    /**
     * Get the value of id_capacite
     */ 
    public function getId_capacite()
    {
        return $this->id_capacite;
    }
}