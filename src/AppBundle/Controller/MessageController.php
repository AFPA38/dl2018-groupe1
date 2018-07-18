<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{

    /**
     *@Route("/message/{id}", name="Message_Index")
     */
    public function indexAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy( array( 'id'=> $id ) );

        return $this->render('message/index.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/sendPost/{id}", name="Message_SendPost")
     */
    public function sendPostAction($id, \Swift_Mailer $mailer, Request $request)
    {
        return $this->sendAction($id, $mailer, $request->request->get('object', 'object'), $request->request->get('message', 'message'));
    }

    public function sendAction($id, $mailer, $object, $message)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUserBy( array( 'id'=> $id ) );

        // Récup donnée utilisateurs : $users->get...()
        // $users->getEmail()

        $message = (new \Swift_Message($object))
            ->setFrom('damien.w42390@gmail.com')
            ->setTo($users->getEmail())
            ->setBody(
                $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                    'email/index.html.twig',
                    array('message' => $message)
                ),
                'text/html'
            )
        ;

        $mailer->send($message);

        return $this->redirectToRoute('Annuaire_Index');

    }

}
