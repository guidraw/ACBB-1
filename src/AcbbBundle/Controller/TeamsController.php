<?php

namespace AcbbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcbbBundle:Default:teams.html.twig');
    }

    public function viewAction($id)
    {
        return new Response("Affichage de l'équipe d'id : ".$id);
    }

    public function scoreAction($id)
    {
        return new Response("Affichage score d'id : ".$id);
    }

    public function timeAction($id)
    {
        return new Response("Affichage horaire d'id : ".$id);
    }

}
