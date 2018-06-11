<?php

namespace AcbbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InscriptionController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcbbBundle:Default:inscription.html.twig');
    }

    public function documentAction()
    {
        return $this->render('AcbbBundle:Default:document.html.twig');
    }

    public function firstStepAction()
    {
        return $this->render('AcbbBundle:Default:firstStep.html.twig');
    }

}
