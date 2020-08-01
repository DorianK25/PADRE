<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mdp',PasswordType::class,[
               "required"=>true,
                "label"=>"Mot de passe :"
            ]);
    }
}