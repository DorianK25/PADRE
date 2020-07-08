<?php 


namespace App\Controller;

use App\Form\ProfType;
use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/professeur")
 */
class ProfesseurController extends AbstractController

{
    /**
     * @Route("/connexion", name="prof_connexion")
     */
    public function connexion(Request $request,ProfesseurRepository $profRepository): Response
    {

        $form=$this->createForm(ProfType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $request->getSession()->set("idProf",$form->getData()["prof"]->getId());
            $request->getSession()->set("Prof",$form->getData()["prof"]);
            return $this->redirectToRoute("main");
        
        }
        
        return $this->render('user/chooseUser.html.twig', [
            'profs' => $profRepository->findAll(),
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/deconnexion", name="prof_deconnexion")
     */
    public function deconnexion(Request $request): Response
    {

        $request->getSession()->remove("Prof");
        return $this->redirectToRoute("main");
    }

    
}