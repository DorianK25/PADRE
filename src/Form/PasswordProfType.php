<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class PasswordProfType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add("mdp",RepeatedType::class,[
            "type"=>PasswordType::class,
            "invalid_message"=>"mot de passes non-identique",
            "first_options"=>["label"=>"Mot de passe : ","attr"=>["class"=>"form-control"]],
            "options"=>["attr"=>["class"=>"form-group"]],
            "second_options"=>["label"=>"Verifier Mot de passe :  ","attr"=>["class"=>"form-control"]],
        ]);
        
    }
}