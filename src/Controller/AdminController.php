<?php

namespace App\Controller;

use App\Form\AdminType;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use App\Repository\Mot_de_passe_adminRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function eleveIndex(Request $request,EleveRepository $eleveRepo){

        $eleves=$eleveRepo->findAll(array('classe' => 'ASC'));

        $action=$request->get("action");

        dump($action);

        switch($action){

            case "index" :


                return $this->render('admin/eleveAdmin.html.twig',[
                    "eleves"=>$eleves,
                ]);
            break;

            case "add":
                $form=$this->createForm(EleveType::class);

                return $this->render('admin/eleveAdmin.html.twig',[
                    "eleves"=>$eleves,
                    "form"=>$form->createView()
                ]);
            break;

            case "edit":

                $eleve=$eleveRepo->find($request->get("eleve"));
                dump($eleve);
                $form=$this->createForm(EleveType::class,$eleve);
                return $this->render('admin/eleveAdmin.html.twig',[
                    "eleves"=>$eleves,
                    "form"=>$form->createView()
                ]);
            break;

            case "del":

                $eleve=$eleveRepo->find($request->get("eleve"));
                return $this->render('admin/eleveAdmin.html.twig',[
                    "eleves"=>$eleves,
                    
                ]);
            break;


        }


       
    }

   

}