<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EleveType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('nom',TextType::class)
        ->add('prenom',TextType::class)
        ->add('date_naissance',DateType::class,[
            'years' => $this->buildYearChoices()
        ])
        ->add('binome',EntityType::class,[
            "class"=>Eleve::class,
        ])
        ->add('groupe',EntityType::class,[
            "class"=>Groupe::class,
        ])
        ->add('classe',EntityType::class,[
            "class"=>Classe::class,
        ])
        ->add('mail',TextType::class)
        ->add('url_photo',FileType::class,[
            "data_class"=>null
        ]);
    }

    public function buildYearChoices()
    {
        $first = new \DateTime('01/01/1950');
        $now = new \DateTime();
        $years = array();
        $years[0] = $first->format('Y');
        $i = 1;
        $oneYear = new \DateInterval('P1Y');
        while($first->format('Y') != $now->format('Y')) {
            $first->add($oneYear);
            $years[$i] = $first->format('Y');
            $i++;
        }
        return array_combine($years, $years);
    }
}