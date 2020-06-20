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
    private $id;




   


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;


    /**
     * Get the value of intutule
     */ 
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set the value of intutule
     *
     * @return  self
     */ 
    public function setIntitule($intitule)
    {
        $this->intutule = $intitule;

        return $this;
    }

    

    

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}