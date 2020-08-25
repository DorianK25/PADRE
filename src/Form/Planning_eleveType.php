<?php

namespace App\Form;

use App\Entity\Capacite;
use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Groupe;
use App\Entity\Planning;
use App\Entity\Tp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class Planning_eleveType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('planning',EntityType::class,[
            "class"=>Planning::class,
            "choice_label" => "nom"
        ])->add('eleve',EntityType::class,[
            "class"=>Eleve::class,
        ])->add('binome',EntityType::class,[
            "class"=>Eleve::class,
        ])->add('tp',EntityType::class,[
            "class"=>Tp::class,
            "choice_label" => "nom_tp"
        ]);
        
    }
    
}