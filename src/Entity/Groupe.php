<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    public function __toString()
    {
        return $this->nom_groupe;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_groupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe")
     */
    private $classe;


    /**
     * Get the value of nom_groupe
     */ 
    public function getNom_groupe()
    {
        return $this->nom_groupe;
    }

    /**
     * Set the value of nom_groupe
     *
     * @return  self
     */ 
    public function setNom_groupe($nom_groupe)
    {
        $this->nom_groupe = $nom_groupe;

        return $this;
    }

    /**
     * Get the value of classe
     */ 
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set the value of classe
     *
     * @return  self
     */ 
    public function setClasse($classe)
    {
        $this->classe = $classe;

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