<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;

class NoteType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach($options["data"]["competences"] as $comp){

            $builder->add("competence_".$comp->getId(),ChoiceType::class,[
                'choices'=>[
                    "Non-Acquis"=>"0",
                    "En Cours d'acquisition" => "1",
                    "Acquis" =>"2",
                    "Maitrisé" => "3"
                ],
                'data'=>"0",
                'expanded'=>true,
                'label'=> "competence ".$comp->getCompetence()->getcode_competence()." : ".$comp->getCompetence()->getIntitule()." => ",
                 "label_attr"=>[
                     "barem"=>$comp->getBarem_competence(),
                     "add"=>"false", 
                    ]
             ]);
        }
    }
}