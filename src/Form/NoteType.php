<?php

namespace App\Form;

use App\Entity\Professeur;
use App\Entity\Acquisition;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class NoteType extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        foreach($options["data"]["competences"] as $comp){
            if(!empty($options["data"]["acquisition"][$comp->getId()]))
                $data=$options["data"]["acquisition"][$comp->getId()][0]->getAcquisition();
            else
                $data=$options["data"]["new"];

            $note=$comp->getBarem_competence()/3*($data->getId()-1);
            
            $builder->add("competence_".$comp->getId(),EntityType::class,[
                "class"=>Acquisition::class,
                "choice_label" => "nom",
                'choice_value' => "id",
                'choice_attr'=>[
                    "class"=>"choix"
                ],
                'data'=>$data,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC');
                },
                
                'expanded'=>true,
                'label'=> "competence ".$comp->getCompetence()->getcode_competence()." : ".$comp->getCompetence()->getIntitule()." : ",
                 "label_attr"=>[
                     "barem"=>$comp->getBarem_competence(),
                     "note"=>round($note,2),
                     "class"=>"comp"
                    ]
             ]);
        }
        
    }
}