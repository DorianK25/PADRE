<?php
namespace App\Controller;

use App\Repository\ClasseRepository;
use App\Repository\EleveRepository;
use App\Repository\TpRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/bilan")
 */
class BilanController extends AbstractController
{

    /**
     * 
     * @Route("/classe",name="indexBilanClasse" )
     */
    public function indexClasse(Request $request,EleveRepository $eleveRepository,TpRepository $tpRepository){


        
        $eleveRepository->findBy(["classe" => $request->get("classe")]);
        $tps=$tpRepository->findAll();

        

        dump("en-cours de creation...");
        die;


    }

    /**
     * 
     * @Route("/",name="indexBilan" )
     */
    public function index(ClasseRepository $classeRepository){

        $classes=$classeRepository->findAll();

        return $this->render('Bilan/BilanIndex.html.twig',[
            "classes"=>$classes
        ]);
        
        dump("en-cours de creation...");
        die;


    }


}