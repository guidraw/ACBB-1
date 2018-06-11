<?php

namespace AcbbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcbbBundle:Default:media.html.twig');
    }

    public function viewAction($id)
    {
        return new Response("Affichage de media d'id : ".$id);
    }

}
