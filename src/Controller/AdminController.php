<?php

namespace App\Controller;

use App\Entity\Tp;
use App\Form\TpType;
use App\Entity\Eleve;
use App\Entity\Classe;
use App\Entity\Groupe;
use App\Entity\Niveau;
use App\Form\AdminType;
use App\Form\EleveType;
use App\Entity\Capacite;
use App\Entity\Planning;
use App\Form\ClasseType;
use App\Form\GroupeType;
use App\Form\NiveauType;
use App\Entity\Competence;
use App\Entity\Professeur;
use App\Form\CapaciteType;
use App\Form\PlanningType;
use App\Form\CompetenceType;
use App\Form\ProfesseurType;
use App\Entity\Planning_eleve;
use App\Form\PasswordProfType;
use App\Form\Planning_eleveType;
use App\Repository\TpRepository;
use App\Repository\EleveRepository;
use App\Form\Mot_de_passe_adminType;
use App\Repository\ClasseRepository;
use App\Repository\GroupeRepository;
use App\Repository\NiveauRepository;
use App\Repository\CapaciteRepository;
use App\Repository\PlanningRepository;
use App\Repository\CompetenceRepository;
use App\Repository\ProfesseurRepository;
use App\Repository\Planning_eleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Mot_de_passe_adminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/admin")
 */
class AdminController extends AbstractController

{

    
    

    /**
     * @Route("/",name="formAdmin" )
     */ 
    public function formulaire(Request $request,Mot_de_passe_adminRepository $mdpRepo){

        $form=$this->createForm(AdminType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->getData()["mdp"]==$mdpRepo->find(1)->getMot_de_passe()){
                $request->getSession()->set("admin",true);
                return $this->redirectToRoute("admin_eleve",[
                    "action"=>"index"
                ]);
            }

        
        }

        return $this->render('admin/formAdmin.html.twig',[
            "form"=>$form->createView(),
            
        ]);
    }

    /**
     * @Route("/eleve",name="admin_eleve" )
     */ 
    public function eleveIndex(Request $request,Planning_eleveRepository $plannings,EleveRepository $eleveRepo){

        
        if(!$request->getSession()->get("admin"))
            return $this->redirectToRoute('formAdmin');

        $eleves=$eleveRepo->findBy([],array('classe' => 'ASC'));

        $action=$request->get("action");

        dump($action);

        switch($action){

            case "index" :


                return $this->render('admin/eleveAdmin.html.twig',[
                    "eleves"=>$eleves,
                ]);
            break;

            case "add":
                $eleve=new Eleve();
                
                $form=$this->createForm(EleveType::class,$eleve);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $eleve=$form->getData();
                    $eleve->setBinome($eleve);
                    if($eleve->getUrl_photo()!=null)
                    $eleve->setUrl_photo($eleve->getUrl_photo()->getClientOriginalName());
                    $this->getDoctrine()->getManager()->persist($eleve);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_eleve',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/eleveAdmin.html.twig',[
                    "eleves"=>$eleves,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $eleve=$eleveRepo->find($request->get("eleve"));
                dump($eleve);
                $form=$this->createForm(EleveType::class,$eleve);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $binome=$eleveRepo->findOneBy(["binome"=>$eleve]);
                    if($binome!=null){
                        if($eleve->getBinome()->getClasse()==$eleve->getClasse())
                        
                        
                            if($binome!=$eleve)
                                $binome->setBinome($binome);
                            else
                                $eleveRepo->findOneBy(["binome"=>$eleve->getBinome()])->setBinome($eleveRepo->findOneBy(["binome"=>$eleve->getBinome()]));
                        $eleve->getBinome()->setBinome($eleve);
                    }else {
                        $eleve->setBinome($eleve);
                        $eleve->getBinome()->setBinome($eleve->getBinome());
                    }
                    if(!is_string($eleve->getUrl_photo()) && $eleve->getUrl_photo()!=null)
                        $eleve->setUrl_photo($eleve->getUrl_photo()->getClientOriginalName());

                    
                    //traitement eleve
                    foreach($plannings->findBy(["Eleve"=>$eleve]) as $planning){
                        dump("eleve");
                        if($plannings->findOneBy(["Eleve"=>$eleve,"Binome"=>$eleve->getBinome(),"Planning"=>$planning->getPlanning(),"tp"=>$planning->getTp()])==null )
                            if($eleve->getBinome()!=$binome && $planning->getBinome()!=$planning->getEleve()){
                                dump("ok1");
                                $planningnew=new Planning_Eleve();
                                $planningnew->setPlanning($planning->getPlanning())->setEleve($binome)->setBinome($binome)->setTp($planning->getTp());
                                $this->getDoctrine()->getManager()->merge($planningnew);
                                $planning->setBinome($eleve->getBinome());
                            }else if($planning->getBinome()==$planning->getEleve()){
                                dump("ok2");
                                $planning->setBinome($eleve->getBinome());
                                
                                $this->getDoctrine()->getManager()->flush();
                                if($plannings->findOneBy(["Eleve"=>$eleve->getBinome(),"Binome"=>$eleve->getBinome()])!=null)
                                $this->getDoctrine()->getManager()->remove($plannings->findOneBy(["Eleve"=>$eleve->getBinome(),"Binome"=>$eleve->getBinome()]));
                                
                            }
                        dump($planning);
                    }
                    $this->getDoctrine()->getManager()->flush();

                    foreach($plannings->findBy(["Binome"=>$eleve]) as $planning){
                        dump("binome");
                        if($plannings->findOneBy(["Eleve"=>$eleve,"Binome"=>$eleve->getBinome(),"Planning"=>$planning->getPlanning(),"tp"=>$planning->getTp()])==null)
                            if($eleve->getBinome()!=$binome && $planning->getBinome()!=$planning->getEleve()){
                                dump("ok1");
                                dump($planning);
                                $planningnew=new Planning_Eleve();
                                $planningnew->setPlanning($planning->getPlanning())->setEleve($binome)->setBinome($binome)->setTp($planning->getTp());
                                $this->getDoctrine()->getManager()->merge($planningnew);
                                $planning->setEleve($eleve->getBinome());
                        }else{
                            dump("ok2");
                            $planning->setEleve($eleve->getBinome());
                        }
                    }
                    $this->getDoctrine()->getManager()->flush();

                    foreach($plannings->findBy(["Binome"=>$eleve->getBinome()]) as $planning){
                        dump("other");
                        if($plannings->findOneBy(["Eleve"=>$eleve,"Binome"=>$eleve->getBinome(),"Planning"=>$planning->getPlanning(),"tp"=>$planning->getTp()])==null)
                            if($planning->getBinome()!=$planning->getEleve()){
                                dump("ok1");
                                dump($planning);
                                $planningnew=new Planning_Eleve();
                                $planningnew->setPlanning($planning->getPlanning())->setEleve($planning->getEleve())->setBinome($planning->getEleve())->setTp($planning->getTp());
                                $this->getDoctrine()->getManager()->merge($planningnew);
                                $planning->setEleve($eleve);
                        }else{
                            dump("ok2");
                            $planning->setEleve($eleve);
                        }
                    }

                    $this->getDoctrine()->getManager()->flush();

                    foreach($plannings->findBy(["Eleve"=>$eleve->getBinome()]) as $planning){
                        dump("other bis");
                        if($plannings->findOneBy(["Eleve"=>$eleve,"Binome"=>$eleve->getBinome(),"Planning"=>$planning->getPlanning(),"tp"=>$planning->getTp()])==null)
                            if($planning->getBinome()!=$planning->getEleve()){
                                dump("ok1");
                                dump($planning);
                                $planningnew=new Planning_Eleve();
                                $planningnew->setPlanning($planning->getPlanning())->setEleve($planning->getBinome())->setBinome($planning->getBinome())->setTp($planning->getTp());
                                $this->getDoctrine()->getManager()->merge($planningnew);
                                $planning->setBinome($eleve);
                        }else{
                            dump("ok2");
                            $planning->setBinome($eleve);
                        }
                    }

                    $this->getDoctrine()->getManager()->flush();

                     /*return $this->redirectToRoute('admin_eleve',[
                        "action"=>"index",
                    ]);*/
                }
                return $this->render('admin/eleveAdmin.html.twig',[
                    "eleves"=>$eleves,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $eleve=$eleveRepo->find($request->get("eleve"));$eleve=$eleveRepo->find($request->get("eleve"));
		foreach($plannings->findBy(["Eleve"=>$eleve]) as $planning){
		if($planning->getEleve()==$planning->getBinome())
			$this->getDoctrine()->getManager()->remove($planning);
		else
			$planning->setEleve($planning->getBinome());

		}
		foreach($plannings->findBy(["Binome"=>$eleve]) as $planning){
		if($planning->getEleve()==$planning->getBinome())
			$this->getDoctrine()->getManager()->remove($planning);
		else
			$planning->setBinome($planning->getEleve());

		}
		if($eleve->getBinome()!=$eleve)
			$eleve->getBinome()->setBinome($eleve->getBinome());
                $this->getDoctrine()->getManager()->remove($eleve);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_eleve',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }

   
    /**
     * @Route("/prof",name="admin_prof" )
     */ 
    public function ProfIndex(Request $request,ProfesseurRepository $professeurRepository){

        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $profs=$professeurRepository->findAll();

        $action=$request->get("action");

        

        switch($action){

            case "index" :


                return $this->render('admin/profAdmin.html.twig',[
                    "profs"=>$profs,
                ]);
            break;

            case "add":

                $prof=new Professeur();
                $form=$this->createForm(ProfesseurType::class,$prof);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $prof=$form->getData();
                    $prof->setMotDePasse(md5(sha1("test")));
                    $this->getDoctrine()->getManager()->persist($prof);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_prof',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/profAdmin.html.twig',[
                    "profs"=>$profs,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $prof=$professeurRepository->find($request->get("prof"));
                $form=$this->createForm(ProfesseurType::class,$prof);
                $formMdp=$this->createForm(PasswordProfType::class);
                $formMdp->handleRequest($request);
                $form->handleRequest($request);
                if($formMdp->isSubmitted() && $formMdp->isValid()){
                        $prof->setMotDePasse(md5(sha1($formMdp->getData()["mdp"])));
                        $this->getDoctrine()->getManager()->flush();
                        return $this->redirectToRoute('admin_prof',[
                            "action"=>"index",
                        ]);
                    
                }
                if($form->isSubmitted() && $form->isValid()){
                    $prof=$form->getData();
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_prof',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/profAdmin.html.twig',[
                    "profs"=>$profs,
                    "formMdp"=>$formMdp->createView(),
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $prof=$professeurRepository->find($request->get("prof"));
                $this->getDoctrine()->getManager()->remove($prof);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_prof',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }

    /**
     * @Route("/planning",name="admin_planning" )
     */ 
    public function PlanningIndex(Request $request,PlanningRepository $planningRepository){

        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $plannings=$planningRepository->findAll();

        $action=$request->get("action");

        

        switch($action){

            case "index" :


                return $this->render('admin/planningAdmin.html.twig',[
                    "plannings"=>$plannings,
                ]);
            break;

            case "add":

                $planning=new Planning();
                $form=$this->createForm(planningType::class,$planning);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $planning=$form->getData();
                    $this->getDoctrine()->getManager()->persist($planning);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_prof',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/planningAdmin.html.twig',[
                    "plannings"=>$plannings,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $planning=$planningRepository->find($request->get("planning"));
                $form=$this->createForm(PlanningType::class,$planning);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $planning=$form->getData();
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_prof',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/planningAdmin.html.twig',[
                    "plannings"=>$plannings,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $planning=$planningRepository->find($request->get("planning"));
                $this->getDoctrine()->getManager()->remove($planning);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_planning',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }

    /**
     * @Route("/planning_eleve",name="admin_planning_eleve" )
     */ 
    public function Planning_eleveIndex(Request $request,ClasseRepository $classeRepo,EleveRepository $eleveRepo,TpRepository $tpRepository,NiveauRepository $niveauRepository,Planning_eleveRepository $planning_eleveRepository){
        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $tps=$tpRepository->findBy(["niveau"=>$request->get("niveau")]);
        $plannings=[];
        dump($tps);
        if(empty($tps)){
            if($request->get("classe")==null)
            	$plannings=$planning_eleveRepository->findAll();
            $tps=$tpRepository->findAll();
        }
        foreach($tps as $tp)
            foreach($planning_eleveRepository->findBy(["tp"=>$tp],['Planning'=>'ASC']) as $planning){
                if($planning->getPlanning()->getClasse()->getId()==$request->get("classe"))
                    $plannings[]=$planning;
            }
        $option["tps"]=$tps;
        $option["eleves"]=$eleveRepo->findBy(["classe"=>$request->get("classe")]);
	

        if($request->get("classe")==null)
            $option["eleves"]=$eleveRepo->findAll();     
        $niveaux=$niveauRepository->findAll();
        $action=$request->get("action");
        
        dump($plannings);
        switch($action){

            case "index" :


                return $this->render('admin/planning_eleveAdmin.html.twig',[
                    "plannings"=>$plannings,
                    "niveaux"=>$niveaux,
                    "niveauSelectionne"=>$request->get("niveau"),
                    "classeSelect"=>$request->get("classe"),
                    "classes"=>$classeRepo->findAll()
                ]);
            break;

            case "add":

                
                $form=$this->createForm(Planning_eleveType::class,$option);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $planning_eleve=new Planning_eleve();
                    $data=$form->getData();
                    $planning_eleve->setPlanning($data["planning"])->setEleve($data["eleve"])->setBinome($data["binome"])->setTp($data["tp"]);
                    $this->getDoctrine()->getManager()->persist($planning_eleve);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_planning_eleve',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/planning_eleveAdmin.html.twig',[
                    "plannings"=>$plannings,
                    "form"=>$form->createView(),
                    "niveaux"=>$niveaux,
                    "niveauSelectionne"=>$request->get("niveau"),
                    "classeSelect"=>$request->get("classe"),
                    "classes"=>$classeRepo->findAll()
                ]);
            break;

            case "edit":
                $option["entity"]=$planning_eleveRepository->find($request->get("planning_eleve"));
                $form=$this->createForm(planning_eleveType::class,$option);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                   
                    $data=$form->getData();
                    $option["entity"]->setPlanning($data["planning"])->setEleve($data["eleve"])->setBinome($data["binome"])->setTp($data["tp"]);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_planning_eleve',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/planning_eleveAdmin.html.twig',[
                    "plannings"=>$plannings,
                    "form"=>$form->createView(),
                    "niveaux"=>$niveaux,
                    "niveauSelectionne"=>$request->get("niveau"),
                    "classeSelect"=>$request->get("classe"),
                    "classes"=>$classeRepo->findAll()
                ]);
            break;

            case "del":

                $planning_eleve=$planning_eleveRepository->find($request->get("planning_eleve"));
                $this->getDoctrine()->getManager()->remove($planning_eleve);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_planning_eleve',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }

    /**
     * @Route("/tp",name="admin_tp" )
     */ 
    public function TpIndex(Request $request,TpRepository $tpRepository){

        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $tps=$tpRepository->findBy([],array('numero' => 'ASC'));

        $action=$request->get("action");

        

        switch($action){

            case "index" :


                return $this->render('admin/tpAdmin.html.twig',[
                    "tps"=>$tps,
                ]);

            break;

            case "add":

                $tp=new Tp();
                $form=$this->createForm(TpType::class,$tp);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $tp=$form->getData();
                    $this->getDoctrine()->getManager()->persist($tp);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_tp',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/tpAdmin.html.twig',[
                    "tps"=>$tps,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $tp=$tpRepository->find($request->get("tp"));
                $form=$this->createForm(TpType::class,$tp);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $prof=$form->getData();
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_tp',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/tpAdmin.html.twig',[
                    "tps"=>$tps,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $tp=$tpRepository->find($request->get("tp"));
                $this->getDoctrine()->getManager()->remove($tp);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_tp',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }

    /**
     * @Route("/Competence",name="admin_competence" )
     */ 
    public function CompetenceIndex(Request $request,CompetenceRepository $competenceRepository){

        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $competences=$competenceRepository->findBy([],["code_competence"=>"ASC"]);

        $action=$request->get("action");

        

        switch($action){

            case "index" :


                return $this->render('admin/competenceAdmin.html.twig',[
                    "competences"=>$competences,
                ]);

            break;

            case "add":

                $competence=new Competence();
                $form=$this->createForm(CompetenceType::class,$competence);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $competence=$form->getData();
                    $this->getDoctrine()->getManager()->persist($competence);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_competence',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/competenceAdmin.html.twig',[
                    "competences"=>$competences,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $competence=$competenceRepository->find($request->get("competence"));
                $form=$this->createForm(CompetenceType::class,$competence);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_competence',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/competenceAdmin.html.twig',[
                    "competences"=>$competences,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $competence=$competenceRepository->find($request->get("competence"));
                $this->getDoctrine()->getManager()->remove($competence);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_competence',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }

    /**
     * @Route("/Capacite",name="admin_capacite" )
     */ 
    public function CapaciteIndex(Request $request,CapaciteRepository $capaciteRepository){

        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $capacites=$capaciteRepository->findAll();

        $action=$request->get("action");

        

        switch($action){

            case "index" :


                return $this->render('admin/capaciteAdmin.html.twig',[
                    "capacites"=>$capacites,
                ]);

            break;

            case "add":

                $capacite=new Capacite();
                $form=$this->createForm(CapaciteType::class,$capacite);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $this->getDoctrine()->getManager()->persist($capacite);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_capacite',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/capaciteAdmin.html.twig',[
                    "capacites"=>$capacites,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $capacite=$capaciteRepository->find($request->get("capacite"));
                $form=$this->createForm(CapaciteType::class,$capacite);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_capacite',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/capaciteAdmin.html.twig',[
                    "capacites"=>$capacites,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $capacite=$capaciteRepository->find($request->get("capacite"));
                $this->getDoctrine()->getManager()->remove($capacite);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_capacite',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }

    /**
     * @Route("/Classe",name="admin_classe" )
     */ 
    public function ClasseIndex(Request $request,ClasseRepository $classeRepository){

        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $classes=$classeRepository->findAll();

        $action=$request->get("action");

        

        switch($action){

            case "index" :


                return $this->render('admin/classeAdmin.html.twig',[
                    "classes"=>$classes,
                ]);

            break;

            case "add":

                $classe=new Classe();
                $form=$this->createForm(ClasseType::class,$classe);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $this->getDoctrine()->getManager()->persist($classe);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_classe',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/classeAdmin.html.twig',[
                    "classes"=>$classes,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $classe=$classeRepository->find($request->get("classe"));
                $form=$this->createForm(ClasseType::class,$classe);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_classe',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/classeAdmin.html.twig',[
                    "classes"=>$classes,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $classe=$classeRepository->find($request->get("classe"));
                $this->getDoctrine()->getManager()->remove($classe);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_classe',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }


    
    /**
     * @Route("/password",name="admin_mdp" )
     */ 
    public function PasswordIndex(Request $request,Mot_de_passe_adminRepository $mot_de_passe_adminRepository){
        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $mdp=$mot_de_passe_adminRepository->find(1);
        $form=$this->createForm(Mot_de_passe_adminType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());
            if($form->getData()["mdp"]==$form->getData()["mdpV"])
                $mdp->setMot_de_passe($form->getData()["mdp"]);
                $this->getDoctrine()->getManager()->flush();
        }
        return $this->render('admin/mot_de_passeAdmin.html.twig',[
            "form"=>$form->createView()
        ]);
    }


    /**
     * @Route("/Niveau",name="admin_niveau" )
     */ 
    public function NiveauIndex(Request $request,NiveauRepository $niveauRepository){
        if(!$request->getSession()->get("admin"))
        return $this->redirectToRoute('formAdmin');
        $niveaux=$niveauRepository->findAll();

        $action=$request->get("action");

        

        switch($action){

            case "index" :


                return $this->render('admin/niveauAdmin.html.twig',[
                    "niveaux"=>$niveaux,
                ]);

            break;

            case "add":

                $niveau=new Niveau();
                $form=$this->createForm(NiveauType::class,$niveau);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $this->getDoctrine()->getManager()->persist($niveau);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_niveau',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/niveauAdmin.html.twig',[
                    "niveaux"=>$niveaux,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $niveau=$niveauRepository->find($request->get("niveau"));
                $form=$this->createForm(NiveauType::class,$niveau);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirectToRoute('admin_niveau',[
                        "action"=>"index",
                    ]);
                }
                return $this->render('admin/niveauAdmin.html.twig',[
                    "niveaux"=>$niveaux,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $niveau=$niveauRepository->find($request->get("niveau"));
                $this->getDoctrine()->getManager()->remove($niveau);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_niveau',[
                    "action"=>"index",
                ]);
            break;


        }


       
    }


}