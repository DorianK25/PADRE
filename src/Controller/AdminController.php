<?php

namespace App\Controller;

use App\Form\ProfType;
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
     * @Route("/", name="mainAdmin")
     */
    public function index(Request $request)
    {


        return $this->render('admin/formAdmin.html.twig');
    }
}