<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AnnuaireController extends Controller
{

    /**
     * @Route("/annuaire", name="Annuaire_Show")
     */
    public function indexAction(Request $request)
    {
        return $this->render('annuaire/test.html.twig');
    }







}
