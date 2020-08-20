<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    function __toString()
    {
        return $this->nom;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    


    

    

    /**
     * Get the value of nom_classe
     */ 
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * Set the value of nom_classe
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

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