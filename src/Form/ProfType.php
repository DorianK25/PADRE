<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prof',EntityType::class,[
                "class"=>Professeur::class,
                "choice_label" => "NomComplet"
                
                
            ]);
    }
}