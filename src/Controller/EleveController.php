<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/eleve")
 */
class EleveController extends AbstractController

{

    /**
     * @Route("/index", name="indexAdmin")
     */
    public function index(Request $request,EleveRepository $eleveRepo)
    {

        $eleve=$eleveRepo->find($request->get("id"));
        dump($eleve);
        
        
    }


}
