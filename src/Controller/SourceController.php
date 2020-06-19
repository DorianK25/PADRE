<?php 


namespace App\Controller;

use App\Form\ProfType;
use App\Repository\SourceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/Source")
 */
class SourceController extends AbstractController

{
    /**
     * @Route("/index", name="source_index")
     */
    public function index(Request $request): Response
    {

        
        
        return $this->render('source/sourceIndex.html.twig', [
            
        ]);
    }

    

    
}