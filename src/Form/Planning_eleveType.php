<?php

namespace App\Form;

use App\Entity\Tp;
use App\Entity\Eleve;
use App\Entity\Classe;
use App\Entity\Groupe;
use App\Entity\Capacite;
use App\Entity\Planning;
use Symfony\Component\Form\FormEvents;
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
	dump($options["data"]["planning"]);
        if(!array_key_exists("entity",$options["data"])){
            $builder->add('planning',EntityType::class,[
                "class"=>Planning::class,
                "choices"=>$options["data"]["planning"],
                "choice_label" => "nom"
            ])->add('eleve',EntityType::class,[
                "class"=>Eleve::class,
                "choices"=>$options["data"]["eleves"],
                
            ])->add('binome',EntityType::class,[
                "data"=>$options["data"]["eleves"][0]->getBinome(),
                "class"=>Eleve::class,
		"choices"=>$options["data"]["eleves"],
            ])->add('tp',EntityType::class,[
                "class"=>Tp::class,
                "choices"=>$options["data"]["tps"],
                "choice_label" => "nom_tp",
                
            ]);
        }else{
            $builder->add('planning',EntityType::class,[
                "class"=>Planning::class,
                "choice_label" => "nom",
                "choices"=>$options["data"]["planning"],
                "data"=>$options["data"]["entity"]->getPlanning()
            ])->add('eleve',EntityType::class,[
                "class"=>Eleve::class,
                "choices"=>$options["data"]["eleves"],
                "data"=>$options["data"]["entity"]->getEleve()
            ])->add('binome',EntityType::class,[
                "class"=>Eleve::class,
                "data"=>$options["data"]["entity"]->getBinome(),
                "choices"=>$options["data"]["eleves"]
            ])->add('tp',EntityType::class,[
                "class"=>Tp::class,
                "choices"=>$options["data"]["tps"],
                "choice_label" => "nom_tp",
                "data"=>$options["data"]["entity"]->getTp()
            ]);
        }

        
        
    }



}