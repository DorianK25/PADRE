<?php

namespace App\Controller;

use App\Form\AdminType;
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
     * @Route("/index", name="indexAdmin")
     */
    public function index(Request $request)
    {


        return $this->render('admin/MainAdmin.html.twig');
    }

    /**
     * @Route("/",name="formAdmin" )
     */ 
    public function formulaire(Request $request,Mot_de_passe_adminRepository $mdpRepo){

        $form=$this->createForm(AdminType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->getData()["mdp"]==$mdpRepo->find(1)->getMot_de_passe()){
                return $this->redirectToRoute("indexAdmin");
            }

        
        }

        return $this->render('admin/formAdmin.html.twig',[
            "form"=>$form->createView(),
            
        ]);
    }
}