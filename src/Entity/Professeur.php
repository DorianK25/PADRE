<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfesseurRepository")
 */
class Professeur implements UserLoaderInterface {


    /**
     * @ORM\id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;


    public function __construct()
    {
        $this->Penom = "dorian";
        $this->Nom = "keurinck";
    }

    
}