<?php 


namespace App\Controller;

use App\Form\ProfType;
use App\Repository\CapaciteRepository;
use App\Repository\CompetenceRepository;
use App\Repository\SourceRepository;
use App\Repository\TpRepository;
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
    public function index(Request $request,CapaciteRepository $capacitesRepo,CompetenceRepository $competencesRepo,TpRepository $tpsRepo): Response
    {

        $tps=$tpsRepo->findAll();
        $competences=$competencesRepo->findAll();
        $capacites=$capacitesRepo->findAll();        
        
        dump($tps);
        dump($competences);
        dump($capacites);

        return $this->render('source/sourceIndex.html.twig', [
            
        ]);
    }

    

    
}