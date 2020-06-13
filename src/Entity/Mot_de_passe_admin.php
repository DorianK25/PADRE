<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Mot_de_passe_adminRepository")
 */
class Mot_de_passe_admin {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_mdp;


    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mot_de_passe;

    


    
}