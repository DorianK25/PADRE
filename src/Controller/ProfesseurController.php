<?php 


namespace App\Controller;

use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/professeur")
 */
class ProfesseurController extends AbstractController

{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(ProfesseurRepository $profRepository): Response
    {
        
        return $this->render('user/chooseUser.html.twig', [
            'profs' => $profRepository->findAll(),
        ]);
    }

    
}