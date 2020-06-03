<?php 


namespace App\Controller;

use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




/**
 * @Route("/professeur")
 */
class ProfesseurController extends AbstractController

{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(ProfesseurRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    
}