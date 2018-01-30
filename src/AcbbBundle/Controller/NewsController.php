<?php

namespace AcbbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcbbBundle:Default:news.html.twig');
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
