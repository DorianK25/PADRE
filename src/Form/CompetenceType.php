<?php

namespace App\Form;

use App\Entity\Capacite;
use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CompetenceType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('code_competence',TextType::class)
        ->add('intitule',TextType::class)
        ->add('capacite',EntityType::class,[
            "class"=>Capacite::class,
        ]);
    }
}