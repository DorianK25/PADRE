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
    private $id_groupe;


    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_groupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe")
     */
    private $classe;

}