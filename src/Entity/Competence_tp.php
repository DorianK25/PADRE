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
     * @ORM\ManyToOne(targetEntity="App\Entity\Competence")
     */
    private $competence;

    /**
     * @ORM\Column(type="integer")
     */
    private $barem_competence;


    

    /**
     * Get the value of id_competence_tp
     */ 
    public function getId_competence_tp()
    {
        return $this->id_competence_tp;
    }

    /**
     * Get the value of tp
     */ 
    public function getTp()
    {
        return $this->tp;
    }

    /**
     * Set the value of tp
     *
     * @return  self
     */ 
    public function setTp($tp)
    {
        $this->tp = $tp;

        return $this;
    }

    

    /**
     * Get the value of barem_competence
     */ 
    public function getBarem_competence()
    {
        return $this->barem_competence;
    }

    /**
     * Set the value of barem_competence
     *
     * @return  self
     */ 
    public function setBarem_competence($barem_competence)
    {
        $this->barem_competence = $barem_competence;

        return $this;
    }

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
}