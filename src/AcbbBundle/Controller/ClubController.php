<?php

namespace AcbbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClubController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcbbBundle:Default:club.html.twig');
    }

    public function historyAction()
    {
        return $this->render('AcbbBundle:Default:history.html.twig');
    }

    public function ceoAction()
    {
        return $this->render('AcbbBundle:Default:ceo.html.twig');
    }
}
