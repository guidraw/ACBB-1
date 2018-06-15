<?php

namespace AcbbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $repoNews = $em->getRepository('AcbbBundle:News');

        $news = $repoNews->findAll();

        return $this->render('AcbbBundle:Default:news.html.twig', array(
            'news'=> $news,
        ));
    }

    public function viewAction($id)
    {
        return new Response("Affichage de news d'id : ".$id);
    }

/*    public function scoreAction()
    {
        return $this->render('AcbbBundle:Default:contact.html.twig');
    }

    public function timeAction()
    {
        return $this->render('AcbbBundle:Default:faq.html.twig');
    }*/

}
