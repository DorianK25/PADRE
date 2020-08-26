<?php 


namespace App\Controller;

use DateTime;
use App\Entity\Eleve;
use App\Form\NoteType;
use App\Entity\tp_note;
use App\Entity\Competence_tp;
use App\Repository\TpRepository;
use App\Repository\EleveRepository;
use App\Entity\Acquisition_tp_eleve;
use App\Repository\ClasseRepository;
use App\Repository\NiveauRepository;
use App\Repository\tp_noteRepository;
use App\Repository\PlanningRepository;
use App\Repository\ProfesseurRepository;
use App\Repository\AcquisitionRepository;
use App\Repository\Competence_tpRepository;
use App\Repository\Planning_eleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Acquisition_tp_eleveRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/Tp")
 */
class TpController extends AbstractController

{


    
    /**
     * @Route("/begin", name="tpbegin")
     *
     * 
     */
    public function begin(TpRepository $tpRepo,EleveRepository $eleveRepo,Request $request,tp_noteRepository $noterepo,ProfesseurRepository $profRepo){
        $eleve=$eleveRepo->find($request->get('eleve'));
        $tp=$tpRepo->find($request->get('tp'));
        $abs=$request->get('abs');
        dump($abs);
        $entityManager = $this->getDoctrine()->getManager();
        if(empty($noterepo->findBy(["eleve"=>$eleve,"tp"=>$tp]))){
            $note=new tp_note();

            
            $note->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("en-cours")->setDate(new DateTime());
            $entityManager->persist($note);
        }
        else{
            $note=$noterepo->findOneBy(["eleve"=>$eleve,"tp"=>$tp]);
            $note->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("en-cours")->setDate(new DateTime());
        }
        if($eleve!=$eleve->getBinome()){
            $eleve=$eleve->getBinome();
            if(empty($noterepo->findBy(["eleve"=>$eleve,"tp"=>$tp]))){
                $note_=new tp_note();

                if($abs=="oui")
                    $note_->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("abs")->setDate(new DateTime());
                else
                    $note_->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("en-cours")->setDate(new DateTime());
                $entityManager->persist($note_);
            }
            elseif($noterepo->findOneBy(["eleve"=>$eleve,"tp"=>$tp])->getEtat()!="noté"){
                $note_=$noterepo->findOneBy(["eleve"=>$eleve,"tp"=>$tp]);
                if($abs=="oui")
                    $note_->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("abs")->setDate(new DateTime());
                else
                    $note_->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("en-cours")->setDate(new DateTime());
            }
        } 
        $entityManager->flush();
        
        $date = new DateTime;
        $response= new JsonResponse(['date' => $date->format("d/m/Y"),"id" => $eleve->getId(),"abs"=>$abs]);
        
        return $response;

    }

     /**
     * @Route("/end", name="tpend")
     *
     * 
     */
    public function end(TpRepository $tpRepo,EleveRepository $eleveRepo,Request $request,tp_noteRepository $noterepo,ProfesseurRepository $profRepo){

        $eleve=$eleveRepo->find($request->get('eleve'));
        $tp=$tpRepo->find($request->get('tp'));
        $entityManager = $this->getDoctrine()->getManager();
        $note=$noterepo->findOneBy(["eleve"=>$eleve,"tp"=>$tp]);
        
        $note->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("terminé")->setDate(new DateTime());
        
        $eleve=$eleve->getBinome(); 
        $note=$noterepo->findOneBy(["eleve"=>$eleve,"tp"=>$tp]);
        
        if($note->getEtat()!="abs" && $note->getEtat()!="noté")
            $note->setEleve($eleve)->setTp($tp)->setProfesseur($profRepo->find($request->getSession()->get("idProf")))->setEtat("terminé")->setDate(new DateTime());
        
            
        $date = new DateTime;
        $response= new JsonResponse(['date' => $date->format("d/m/Y"),"id" => $eleve->getId(),"abs"=>$note->getEtat()]);
        
        $entityManager->flush();

        return $response;

    }

    /**
     * @Route("/resume", name="tpResume")
     *
     * 
     */
    public function resume (Request $request,Planning_eleveRepository $planningRepository,NiveauRepository $niveauRepo,ClasseRepository $classeRepository,TpRepository $tpsRepo,EleveRepository $eleveRepo,tp_noteRepository $tp_noteRepository,Competence_tpRepository $compTpRepo){

        $notesbis=$tp_noteRepository->findAll();
        $classes=$classeRepository->findAll();
        $classe=$request->get("classe");
        $niveau=$request->get("niveau");
        if($niveau == null){
            $niveau=$niveauRepo->findOneBy([],array('id' => 'ASC'));
            
            
        }
        $planning_=[];
        $tps=$tpsRepo->findBy(["niveau"=>$niveau],array('numero' => 'ASC'));
        if($classe == null){
            $classe=$classes[0];
        }
        $eleves=$eleveRepo->findBy(["classe"=>$classe]);
        $eleveParClasse =[];
        $note=[];
        foreach($eleves as $eleve){

            
            $eleveParClasse["eleve"][]=$eleve;

        }
        $allPlanning=$planningRepository->findAll();
        foreach($allPlanning as $planning){
            $planning_[$planning->getPlanning()->getId()]=$planning;
            $eleveParClasse[$planning->getEleve()->getId()]["planning"][$planning->getTp()->getId()]=$planning;
            $eleveParClasse[$planning->getBinome()->getId()]["planning"][$planning->getTp()->getId()]=$planning;
        }
        foreach($notesbis as $note_){
            $note[$note_->getEleve()->getId()][$note_->getTp()->getId()]=$note_;

        }


        dump($eleveParClasse);
        return $this->render('Tp/TpSelect.html.twig', [
            "tps"=>$tps,
            "note"=>$note,
            "eleveParClasse"=>$eleveParClasse,
            "classes"=>$classes,
            "niveaux"=>$niveauRepo->findAll(),
            "planning"=>$planning_
        ]);

    }

    /**
     * @Route("/delete", name="tpDel")
     *
     * 
     */
    public function tpDelete(Request $request,TpRepository $tpRepository,Competence_tpRepository $compTpRepo,tp_noteRepository $tpNoteRepository,Acquisition_tp_eleveRepository $acquisition_tp_eleveRepository,EleveRepository $eleveRepo){
            $eleve=$eleveRepo->find($request->get("eleve"));
            $tp=$tpRepository->find($request->get("tp"));
            $note=$tpNoteRepository->findOneBy(["eleve"=>$eleve,"tp"=>$tp]);
            $comps=$compTpRepo->findBy(["tp"=>$tp]);
            $acquisition=[];
            foreach ($comps as $comp)
                $acquisitions[]=$acquisition_tp_eleveRepository->findBy(["eleve"=>$eleve,"Competence_tp"=>$comp]);
            $this->getDoctrine()->getManager()->remove($note);
            foreach ($acquisition as $acquisitions)    
                $this->getDoctrine()->getManager()->remove($acquisition);

            
                
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("tpIndex",[
                "classe"=>$eleve->getClasse()->getId(),
                "niveau"=>$tp->getNiveau()
            ]);


    }


    /**
     * @Route("/index", name="tpIndex")
     *
     * 
     */
    public function index(Request $request,NiveauRepository $niveauRepo,ClasseRepository $classeRepository,TpRepository $tpsRepo,EleveRepository $eleveRepo,tp_noteRepository $tp_noteRepository,Competence_tpRepository $compTpRepo){

        
        $notesbis=$tp_noteRepository->findAll();
        $classes=$classeRepository->findAll();
        $classe=$request->get("classe");
        $niveau=$request->get("niveau");
        if($niveau == null){
            $niveau=$niveauRepo->findOneBy([],array('id' => 'ASC'));
            
            
        }
        $tps=$tpsRepo->findBy(["niveau"=>$niveau],array('numero' => 'ASC'));
        if($classe == null){
            $classe=$classes[0];
        }
        $eleves=$eleveRepo->findBy(["classe"=>$classe]);
        $eleveParClasse =[];
        $note=[];
        foreach($eleves as $eleve){

            
            $eleveParClasse[]=$eleve;

        }

        foreach($notesbis as $note_){
            $note[$note_->getEleve()->getId()][$note_->getTp()->getId()]=$note_;

        }

        return $this->render('Tp/TpIndex.html.twig', [
            "tps"=>$tps,
            "note"=>$note,
            "eleveParClasse"=>$eleveParClasse,
            "classes"=>$classes,
            "niveaux"=>$niveauRepo->findAll()
        ]);

    }

    /**
     * @Route("/add", name="tpAdd")
     * @param Eleve $eleve
     * @param Tp $tp
     * @
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
        $prof=$profRepo->find($request->getSession()->get("idProf"));
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $notefinal=0;
            foreach($form->getData()["competences"] as $comp){
                $notefinal+=($comp->getbarem_competence()/3)*($form->getData()["competence_".$comp->getId()]->getId()-1);
                if(empty($acquisition_tp_eleveRepository->findBy(["eleve"=>$eleve,"Competence_tp"=>$comp]))){
                    $acquisition=new Acquisition_tp_eleve();
                    $acquisition->setEleve($eleve)->setCompetence_tp($comp)->setProfesseur($prof)->setAcquisition($form->getData()["competence_".$comp->getId()]);
                    $entityManager->merge($acquisition);
                    
                }else{
                    $acquisition=$acquisition_tp_eleveRepository->findBy(["eleve"=>$eleve,"Competence_tp"=>$comp])[0];
                    $acquisition->setEleve($eleve)->setCompetence_tp($comp)->setProfesseur($prof)->setAcquisition($form->getData()["competence_".$comp->getId()]);
                    
                }
            }
                $note=$noterepo->findOneBy(["eleve"=>$eleve,"tp"=>$tp]);
                $note->setEleve($eleve)->setTp($tp)->setProfesseur($prof)->setNote(round($notefinal,2))->setEtat("noté")->setDate(new DateTime());;
                
            
            $binome=$eleveRepo->find($eleve->getBinome());
            if($eleve!=$binome && $noterepo->findOneBy(["eleve"=>$binome,"tp"=>$tp])->getEtat()!="abs" && $noterepo->findOneBy(["eleve"=>$binome,"tp"=>$tp])->getEtat()!="noté"){
                
                

                foreach($form->getData()["competences"] as $comp){
                    if(empty($acquisition_tp_eleveRepository->findBy(["eleve"=>$binome,"Competence_tp"=>$comp]))){
                        $acquisition=new Acquisition_tp_eleve();
                        $acquisition->setEleve($binome)->setCompetence_tp($comp)->setProfesseur($prof)->setAcquisition($form->getData()["competence_".$comp->getId()]);
                        $entityManager->merge($acquisition);
                        
                    }else{
                        $acquisition=$acquisition_tp_eleveRepository->findBy(["eleve"=>$binome,"Competence_tp"=>$comp])[0];
                        $acquisition->setEleve($binome)->setCompetence_tp($comp)->setProfesseur($prof)->setAcquisition($form->getData()["competence_".$comp->getId()]);
                        
                    }
                }
                if(empty($noterepo->findBy(["eleve"=>$binome,"tp"=>$tp]))){
                    $note=new tp_note();
                    $note->setEleve($binome)->setTp($tp)->setProfesseur($prof)->setEtat("noté")->setDate(new DateTime())->setNote(round($notefinal,2));
                    $entityManager->merge($note);
                    
                }else{
                    $note=$noterepo->findBy(["eleve"=>$binome,"tp"=>$tp])[0];
                    $note->setEleve($binome)->setTp($tp)->setProfesseur($prof)->setEtat("noté")->setDate(new DateTime())->setNote(round($notefinal,2));
                    
                }
                
        }
            $entityManager->flush();
            return $this->redirectToRoute("tpIndex",[
                "classe"=>$eleve->getClasse()->getId(),
                ]);
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