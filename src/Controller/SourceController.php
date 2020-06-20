<?php 


namespace App\Controller;

use App\Entity\Capacite;
use App\Entity\Competence;
use App\Form\ProfType;
use App\Repository\CapaciteRepository;
use App\Repository\CompetenceRepository;
use App\Repository\SourceRepository;
use App\Repository\TpRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/Source")
 */
class SourceController extends AbstractController

{
    /**
     * @Route("/index", name="source_index")
     */
    public function index(Request $request,CapaciteRepository $capacitesRepo,CompetenceRepository $competencesRepo,TpRepository $tpsRepo): Response
    {

        $tps=$tpsRepo->findAll();
        $competences_=$competencesRepo->findBy([],["capacite"=>'ASC']);
        $capacites_=$capacitesRepo->findAll();        
        foreach($competences_ as $competence){
            $competences[$competence->getCapacite()->getId()][]=$competence;

        }
        foreach($capacites_ as $capacite){
            $capacites[$capacite->getId()][]=$capacite;

        }
        dump($tps);
        dump($competences);
        dump($capacites);

        return $this->render('source/sourceIndex.html.twig', [
            "tps"=>$tps,
            "capacites"=>$capacites,
            "competences"=>$competences
        ]);
    }

    

    
}