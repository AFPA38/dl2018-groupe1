<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MessageController extends Controller
{

    /**
     * [indexAction description]
     *@Route("/message", name="Message_index")
     *
     */
    public function indexAction()
    {
        return $this->render('message/index.html.twig');
    }



}
