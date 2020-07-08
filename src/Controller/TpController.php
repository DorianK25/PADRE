<?php 


namespace App\Controller;

use App\Entity\Eleve;
use App\Form\NoteType;
use App\Entity\tp_note;
use App\Entity\Competence_tp;
use App\Repository\TpRepository;
use App\Repository\EleveRepository;
use App\Entity\Acquisition_tp_eleve;
use App\Repository\tp_noteRepository;
use App\Repository\Competence_tpRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Acquisition_tp_eleveRepository;
use App\Repository\AcquisitionRepository;
use App\Repository\ProfesseurRepository;
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
    public function ajouterNote(Request $request,AcquisitionRepository $acquisitionRepository,tp_noteRepository $tp_noteRepository,ProfesseurRepository $profRepo ,EleveRepository $eleveRepo,TpRepository $tpRepo,Competence_tpRepository $compTpRepo,tp_noteRepository $noterepo,Acquisition_tp_eleveRepository $acquisition_tp_eleveRepository){
        $eleve=$eleveRepo->find($request->get('eleve'));
        $tp=$tpRepo->find($request->get('tp'));
        $competences=$compTpRepo->findBy(["tp"=>$tp]);
        foreach($competences as $comp)
            $acquisition_[$comp->getId()]=$acquisition_tp_eleveRepository->findBy(["eleve"=>$eleve,"Competence_tp"=>$comp]);
        $notebdd=$tp_noteRepository->findOneBy(["tp"=>$tp,"eleve"=>$eleve]);
        $form=$this->createForm(NoteType::class,["competences"=>$competences,"acquisition"=>$acquisition_,"new"=>$acquisitionRepository->find(1)]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $notefinal=0;
            foreach($form->getData()["competences"] as $comp){
                $notefinal+=($comp->getbarem_competence()/3)*($form->getData()["competence_".$comp->getId()]->getId()-1);
                if(empty($acquisition_tp_eleveRepository->findBy(["eleve"=>$eleve,"Competence_tp"=>$comp]))){
                    $acquisition=new Acquisition_tp_eleve();
                    $acquisition->setEleve($eleve)->setCompetence_tp($comp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setAcquisition($form->getData()["competence_".$comp->getId()]);
                    $entityManager->merge($acquisition);
                    
                }else{
                    $acquisition=$acquisition_tp_eleveRepository->findBy(["eleve"=>$eleve,"Competence_tp"=>$comp])[0];
                    $acquisition->setEleve($eleve)->setCompetence_tp($comp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setAcquisition($form->getData()["competence_".$comp->getId()]);
                    
                }
            }
            if(empty($noterepo->findBy(["eleve"=>$eleve,"tp"=>$tp]))){
                $note=new tp_note();
                $note->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setNote(round($notefinal,2));
                $entityManager->merge($note);
                
            }else{
                $note=$noterepo->findBy(["eleve"=>$eleve,"tp"=>$tp])[0];
                $note->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setNote(round($notefinal,2));
                
            }
            
            
            $entityManager->flush();
            return $this->redirectToRoute("tpIndex");
        }
        return $this->render('Tp/TpAddNote.html.twig', [
            "tp"=>$tp,
            "eleve"=>$eleve,
            "competences"=>$competences,
            "acquisition"=>$acquisition_,
            "prof"=>$request->getSession()->get("Prof"),
            "form"=>$form->createView(),
            "noteBdd"=>$notebdd
            ]);
        


    }

    
    

    
}