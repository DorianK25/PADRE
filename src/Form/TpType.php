<?php

namespace App\Form;

use App\Entity\Classe;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class TpType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('nom_tp',TextType::class)
        ->add('domaine',TextType::class)
        ->add('numero',IntegerType::class)
        ->add('nom_fichier',TextType::class)
        ->add('descriptif',TextType::class);
        
    }
}