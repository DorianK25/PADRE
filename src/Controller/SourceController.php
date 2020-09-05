<?php 


namespace App\Controller;

use App\Entity\Competence;
use App\Entity\Competence_tp;
use App\Entity\Tp;
use App\Repository\CapaciteRepository;
use App\Repository\Competence_tpRepository;
use App\Repository\CompetenceRepository;
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
    public function index(Request $request,CapaciteRepository $capacitesRepo,CompetenceRepository $competencesRepo,TpRepository $tpsRepo,Competence_tpRepository $compTpRepo): Response
    {

        $request->getSession()->set("admin",false);

        $tps=$tpsRepo->findBy([],array('numero' => 'ASC'));
        $competences_=$competencesRepo->findBy([],["capacite"=>'ASC',"code_competence"=>"ASC"]);
        $capacites_=$capacitesRepo->findAll();
        $competencesTp_=$compTpRepo->findAll();
        foreach($competencesTp_ as $competenceTp){
            $competencesTp[$competenceTp->getCompetence()->getId()][$competenceTp->getTp()->getId()][]=$competenceTp;

        }        
        foreach($competences_ as $competence){
            $competences[$competence->getCapacite()->getId()][]=$competence;

        }
        foreach($capacites_ as $capacite){
            $capacites[$capacite->getId()][]=$capacite;

        }
        $tpA=$tps;
        if($request->get("num")!=null)
            $tps=$tpsRepo->findBy(["numero"=>$request->get("num")],array('numero' => 'ASC'));
        
        return $this->render('source/sourceIndex.html.twig', [
            "tps"=>$tps,
            "capacites"=>$capacites,
            "competences"=>$competences,
            "competencesTp"=>$competencesTp,
            "tpA"=>$tpA
        ]);
    }
    /**
     * @Route("/create", name="source_create")
     * 
     */
    public function create(CompetenceRepository $competencesRepo,Competence_tpRepository $compTpRepo,TpRepository $tpsRepo,Request $request)
    {

        $request->getSession()->set("admin",false);

        $competenceTp=new Competence_tp();
        $entityManager = $this->getDoctrine()->getManager();
        $tp=$tpsRepo->find($request->get("idTp"));
        $competence=$competencesRepo->find($request->get("idCompetence"));
        $competenceTp->setTp($tp)->setCompetence($competence)->setBarem_competence($request->get("barem"));
        $competenceTpbis=$compTpRepo->findOneBy(["tp" => $competenceTp->getTp(),"competence"=>$competenceTp->getCompetence()]);
        if($competenceTp->getBarem_competence()!=0)
            if($competenceTpbis){

                if($competenceTpbis->getBarem_competence()!=$competenceTp->getBarem_competence()){
                    $competenceTpbis->setBarem_competence($competenceTp->getBarem_competence());
                    $entityManager->flush();

                }
            }else{
                $entityManager->persist($competenceTp);
                $entityManager->flush();
            }



        

        return new Response("success");
        
    }

    

    
}