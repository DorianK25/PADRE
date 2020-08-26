<?php

namespace App\Form;

use App\Entity\Capacite;
use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PlanningType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('couleur',ColorType::class)
        ->add('date',DateType::class,[
            
            'required'=>false
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