<?php

namespace AcbbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcbbBundle:Default:index.html.twig');
    }

    public function schoolAction()
    {
        return $this->render('AcbbBundle:Default:school.html.twig');
    }

    public function contactAction()
    {
        return $this->render('AcbbBundle:Default:contact.html.twig');
    }

    public function faqAction()
    {
        return $this->render('AcbbBundle:Default:faq.html.twig');
    }

}
