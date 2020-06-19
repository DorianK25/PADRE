<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TpRepository")
 */
class Tp {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_tp;


    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_tp;

    


    

    /**
     * Get the value of id_tp
     */ 
    public function getId_tp()
    {
        return $this->id_tp;
    }

    /**
     * Get the value of nom_tp
     */ 
    public function getNom_tp()
    {
        return $this->nom_tp;
    }

    /**
     * Set the value of nom_tp
     *
     * @return  self
     */ 
    public function setNom_tp($nom_tp)
    {
        $this->nom_tp = $nom_tp;

        return $this;
    }
}