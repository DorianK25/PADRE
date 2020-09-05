<?php

namespace App\Controller;

use App\Repository\TpRepository;
use App\Repository\EleveRepository;
use App\Repository\tp_noteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/eleve")
 */
class EleveController extends AbstractController

{

    /**
     * @Route("/getEleve",name="getEleve")
     */
    public function getEleve(Request $request,EleveRepository $eleveRepo){


        $eleve=$eleveRepo->find($request->get("eleve"));
        $response= new JsonResponse(['eleve' => $eleve->getBinome()->getNom()." ".$eleve->getBinome()->getPrenom(),"id" => $eleve->getBinome()->getId()]);
        return $response;
    }

    /**
     * @Route("/index", name="indexEleve")
     */
    public function index(Request $request,EleveRepository $eleveRepo,TpRepository $tpRepo,tp_noteRepository $tpNoteRepo)
    {
        $request->getSession()->set("admin",false);
        $eleve=$eleveRepo->find($request->get("id"));
        $niveau=$request->get('niveau');
        $tps=$tpRepo->findBy(["niveau" => $niveau],["numero" => "ASC"]);
        
        $tpsNote=[];

        $tpsAR=[];

        foreach ($tps as $tp) {
            if($tpNoteRepo->findOneBy(["eleve" => $eleve, "tp" => $tp->getId()]) && $tpNoteRepo->findOneBy(["eleve" => $eleve, "tp" => $tp->getId()])->getEtat()!= "abs" && $tpNoteRepo->findOneBy(["eleve" => $eleve, "tp" => $tp->getId()])->getEtat()!= "en-cours")
                $tpsNote[]=$tpNoteRepo->findOneBy(["eleve" => $eleve, "tp" => $tp->getId()]);
            else {
                $tpsAR[]=$tp;
            }
        }




        return $this->render('Eleve/eleveIndex.html.twig',[
            "eleve"=>$eleve,
            "tpsAR"=>$tpsAR,
            "tpsNote"=>$tpsNote
        ]);
        
    }


}
