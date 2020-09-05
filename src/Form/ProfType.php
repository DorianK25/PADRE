<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ProfType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prof',EntityType::class,[
                "class"=>Professeur::class,
                "choice_label" => "NomComplet"
                
                
            ])->add("motDePasse",PasswordType::class);
    }
}