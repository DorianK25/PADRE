<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Groupe;
use App\Repository\EleveRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EleveType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        dump($options);
        $builder->add('nom',TextType::class)
        ->add('prenom',TextType::class)
        ->add('date_naissance',DateType::class,[
            'years' => $this->buildYearChoices(),
            'required'=>false
        ])
        ->add('binome',EntityType::class,[
            "class"=>Eleve::class,
            "data"=>$options["data"]->getBinome(),
            'required'=>false,
            'query_builder' => function (EleveRepository $er) use($options){
                return $er->createQueryBuilder('u')
                ->Where('u.classe IN (:classe)')
                ->setParameter('classe', $options["data"]->getClasse());;
            }
        ])
        ->add('groupe',EntityType::class,[
            "class"=>Groupe::class,
            "data"=>$options["data"]->getGroupe(),
            'required'=>false
        ])
        ->add('classe',EntityType::class,[
            "class"=>Classe::class,
            'required'=>false
        ])
        ->add('mail',TextType::class,[
            'required'=>false
        ])
        ->add('url_photo',FileType::class,[
            "data_class"=>null,
            "empty_data"=>$options["data"]->getUrl_photo(),
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