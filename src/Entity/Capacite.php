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
    private $intutule;


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
     * Get the value of id_capacite
     */ 
    public function getId_capacite()
    {
        return $this->id_capacite;
    }

    
}