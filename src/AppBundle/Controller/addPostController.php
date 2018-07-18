<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;
use AppBundle\Form\PostType;

class addPostController extends Controller
{
        /**
     * Undocumented function
     *
     * @Route("/addPost", name="addPost_index")
     */
    public function indexAction(Request $request)
    {
        //création du formulaire
        $form = $this->createForm(PostType::class);

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('AppBundle:Post')->findAll();

        //on vérifie si le formulaire est bien valide.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
                
            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'Post bien enregistré');

            return $this->redirectToRoute('blog_index');
        }
        //on transmet ici le formulaire
        return $this->render("blog/addPost.html.twig", [
            //'posts' => $posts,
            'form' => $form->createView(),
            ]);
        
    }
}
