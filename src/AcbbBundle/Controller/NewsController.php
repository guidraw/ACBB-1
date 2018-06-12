<?php

namespace AcbbBundle\Controller;

use AcbbBundle\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function indexAction()
    {
        //    $match1 = $this->container->get('accb.match');
        $match = new Match();
        return $this->render('AcbbBundle:Default:news.html.twig', array(
            'match'=> $match,
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
