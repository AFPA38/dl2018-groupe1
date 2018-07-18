<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AnnuaireController extends Controller
{

    /**
     * @Route("/annuaire", name="Annuaire_Index")
     */
    public function indexAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('annuaire/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Route("/annuaire/{id}", name="Annuaire_Show")
     */
    public function showSingleAction($id)
    {
        return $this->render('annuaire/singleView.html.twig');
    }





}
