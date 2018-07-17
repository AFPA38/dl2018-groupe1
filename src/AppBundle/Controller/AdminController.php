<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    
    /**
     * [indexAction description]
     * @Route("/admin", name="Admin_Index")
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }

    public function promoteUserAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('username' => 'gauss'));
        $user->addRole('ROLE_ADMIN');
        $userManager->updateUser($user);
    }

}
