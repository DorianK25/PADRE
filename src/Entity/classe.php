<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_classe;


    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_classe;

    /**
     * @ORM\Column(type="date")
     */
    private $annee;


    

    /**
     * Get the value of id_classe
     */ 
    public function getId_classe()
    {
        return $this->id_classe;
    }

    /**
     * Get the value of nom_classe
     */ 
    public function getNom_classe()
    {
        return $this->nom_classe;
    }

    /**
     * Set the value of nom_classe
     *
     * @return  self
     */ 
    public function setNom_classe($nom_classe)
    {
        $this->nom_classe = $nom_classe;

        return $this;
    }

    /**
     * Get the value of annee
     */ 
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */ 
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }
}