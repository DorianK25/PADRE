<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Planning_eleveRepository")
 */
class Planning_eleve {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Planning",fetch="EAGER")
     */
    private $Planning;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eleve")
     */
    private $Eleve;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eleve")
     */
    private $Binome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tp")
     */
    private $tp;



    

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    


    /**
     * Get the value of Planning
     */ 
    public function getPlanning()
    {
        return $this->Planning;
    }

    /**
     * Set the value of Planning
     *
     * @return  self
     */ 
    public function setPlanning($Planning)
    {
        $this->Planning = $Planning;

        return $this;
    }

    /**
     * Get the value of Eleve
     */ 
    public function getEleve()
    {
        return $this->Eleve;
    }

    /**
     * Set the value of Eleve
     *
     * @return  self
     */ 
    public function setEleve($Eleve)
    {
        $this->Eleve = $Eleve;

        return $this;
    }

    /**
     * Get the value of Binome
     */ 
    public function getBinome()
    {
        return $this->Binome;
    }

    /**
     * Set the value of Binome
     *
     * @return  self
     */ 
    public function setBinome($Binome)
    {
        $this->Binome = $Binome;

        return $this;
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
}