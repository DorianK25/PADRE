<?php 


namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Competence_tp;
use App\Entity\tp_note;
use App\Form\NoteType;
use App\Repository\TpRepository;
use App\Repository\EleveRepository;
use App\Repository\tp_noteRepository;
use App\Repository\Competence_tpRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/Tp")
 */
class TpController extends AbstractController

{

    /**
     * @Route("/index", name="tpIndex")
     *
     * 
     */
    public function index(TpRepository $tpsRepo,EleveRepository $eleveRepo,tp_noteRepository $tp_noteRepository,Competence_tpRepository $compTpRepo){

        $tps=$tpsRepo->findAll();
        $notesbis=$tp_noteRepository->findAll();
        $eleves=$eleveRepo->findAll();
        $eleveParClasse =[];
        $note=[];
        foreach($eleves as $eleve){

            
            $eleveParClasse[$eleve->getClasse()->getId()][$eleve->getId()]=$eleve;

        }

        foreach($notesbis as $note_){
            $note[$note_->getEleve()->getId()][$note_->getTp()->getId()]=$note_;

        }

        
        return $this->render('Tp/TpIndex.html.twig', [
            "tps"=>$tps,
            "note"=>$note,
            "eleveParClasse"=>$eleveParClasse,
        ]);

    }

    /**
     * @Route("/add", name="tpAdd")
     * @param Eleve $eleve
     * @param Tp $tp
     */
    public function ajouterNote(Request $request,EleveRepository $eleveRepo,TpRepository $tpRepo,Competence_tpRepository $compTpRepo){
        $eleve=$eleveRepo->find($request->get('eleve'));
        $tp=$tpRepo->find($request->get('tp'));
        $competences=$compTpRepo->findBy(["tp"=>$tp]);

        $form=$this->createForm(NoteType::class,["competences"=>$competences]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $note=new tp_note();
            $notefinal=0;
            foreach($form->getData()["competences"] as $comp){
                $notefinal+=($comp->getbarem_competence()/3)*$form->getData()["competence_".$comp->getId()];
                
            }
            
            $note->setEleve($eleve)->setTp($tp)->setProfesseur($request->getSession()->get("Prof"))->setNote(round($notefinal,2));
            
            $entityManager->merge($note);
            $entityManager->flush();
            return $this->redirectToRoute("tpIndex");
        }
        return $this->render('Tp/TpAddNote.html.twig', [
            "tp"=>$tp,
            "eleve"=>$eleve,
            "competences"=>$competences,
            "prof"=>$request->getSession()->get("Prof"),
            "form"=>$form->createView(),
            ]);
        


    }

    
    

    
}