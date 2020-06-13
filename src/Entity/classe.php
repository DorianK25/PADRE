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


    
}