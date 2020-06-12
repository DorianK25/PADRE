<?php 


namespace App\Controller;

use App\Form\ProfType;
use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/")
 */
class MainController extends AbstractController

{

    /**
     * @Route("/", name="main")
     */
    public function index(Request $request)
    {
        
        
        return $this->render('base.html.twig');
    }

}