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
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(Request $request,ProfesseurRepository $profRepository): Response
    {

        $form=$this->createForm(ProfType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
        
        }
        
        return $this->render('user/chooseUser.html.twig', [
            'profs' => $profRepository->findAll(),
            'form'=> $form->createView(),
        ]);
    }

    
}