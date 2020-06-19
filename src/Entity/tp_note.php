<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\tp_noteRepository")
 */
class tp_note {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id_tp_note;


    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eleve")
     */
    private $eleve;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tp")
     */
    private $tp;
 
    /** 
     * @ORM\Column(type="integer")
    */
    private $note;
    
}