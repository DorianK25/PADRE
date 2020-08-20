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
    private $id;


    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_tp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domaine;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_fichier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau")
     */
    private $niveau;

    /**
     * Get the value of nom_tp
     */ 
    public function getNom_tp()
    {
        return $this->nom_tp;
    }

    /**
     * Get the value of nom_tp
     */ 
    public function getNomTp()
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

    /**
     * Set the value of nom_tp
     *
     * @return  self
     */ 
    public function setNomTp($nom_tp)
    {
        $this->nom_tp = $nom_tp;

        return $this;
    }

    /**
     * Get the value of domaine
     */ 
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Set the value of domaine
     *
     * @return  self
     */ 
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of nom_fichier
     */ 
    public function getNom_fichier()
    {
        return $this->nom_fichier;
    }

    /**
     * Get the value of nom_fichier
     */ 
    public function getNomFichier()
    {
        return $this->nom_fichier;
    }

    /**
     * Set the value of nom_fichier
     *
     * @return  self
     */ 
    public function setNom_fichier($nom_fichier)
    {
        $this->nom_fichier = $nom_fichier;

        return $this;
    }

    /**
     * Set the value of nom_fichier
     *
     * @return  self
     */ 
    public function setNomFichier($nom_fichier)
    {
        $this->nom_fichier = $nom_fichier;

        return $this;
    }

    /**
     * Get the value of descriptif
     */ 
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set the value of descriptif
     *
     * @return  self
     */ 
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of niveau
     */ 
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set the value of niveau
     *
     * @return  self
     */ 
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }
}