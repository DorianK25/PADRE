<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Acquisition_tp_eleveRepository")
 */
class Acquisition_tp_eleve {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()

     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eleve")
     */
    private $eleve;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competence_tp")
     */
    private $Competence_tp;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\acquisition")
     */
    private $acquisition;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Professeur")
     */
    private $Professeur;




    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of eleve
     */ 
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * Set the value of eleve
     *
     * @return  self
     */ 
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;

        return $this;
    }

    /**
     * Get the value of Competence_tp
     */ 
    public function getCompetence_tp()
    {
        return $this->Competence_tp;
    }

    /**
     * Set the value of Competence_tp
     *
     * @return  self
     */ 
    public function setCompetence_tp($Competence_tp)
    {
        $this->Competence_tp = $Competence_tp;

        return $this;
    }

    /**
     * Get the value of acquisition
     */ 
    public function getAcquisition()
    {
        return $this->acquisition;
    }

    /**
     * Set the value of acquisition
     *
     * @return  self
     */ 
    public function setAcquisition($acquisition)
    {
        $this->acquisition = $acquisition;

        return $this;
    }

    /**
     * Get the value of Professeur
     */ 
    public function getProfesseur()
    {
        return $this->Professeur;
    }

    /**
     * Set the value of Professeur
     *
     * @return  self
     */ 
    public function setProfesseur($Professeur)
    {
        $this->Professeur = $Professeur;

        return $this;
    }
}