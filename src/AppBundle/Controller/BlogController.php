<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;
use AppBundle\Form\PostType;
use AppBundle\Form\CommentType;

//use AppBundle\Entity\User;

class BlogController extends Controller
{
    /**
     * 
     *
     * @Route("/blog", name="blog_index")
     */
    public function IndexAction(Request $request)
    {
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

        return $this->render("blog/index.html.twig", [
            'posts' => $posts,
            'form' => $form->createView(),
            ]);
    }


    /**
     * Undocumented function
     *
     * @Route("/blog/{id}", name="blog_show", requirements={"id": "\d+"})
     */
    public function ShowAction($id, Request $request)
    {
        $form = $this->createForm(CommentType::class);

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:Post')->find($id);

        $comments = $em->getRepository('AppBundle:Comment')->findByPost($post->getId());

        //on vérifie si le formulaire est bien valide.
        $form->handleRequest($request, $id);

        if ($form->isSubmitted() && $form->isValid())
        {
            $comment = $form->getData();

            $em->persist($comment);
            $em->flush();


            return $this->redirectToRoute('blog_index');
        }

        return $this->render("blog/show.html.twig", [
            'post' => $post,
            'comments'=> $comments,
            'form' => $form->createView()
        ]);
    }
}
