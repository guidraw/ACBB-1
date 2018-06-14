<?php

namespace AcbbBundle\Controller;

use AcbbBundle\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction()
    {

        $match = new Match();
        $em = $this->getDoctrine()->getManager();


        $repoMatch = $em->getRepository('AcbbBundle:Match');

        $matches = $repoMatch->findAll();


        return $this->render('AcbbBundle:Default:index.html.twig', array(
            'matches'=> $matches
        ));
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

    public function redirectOldAction()
    {
        return $this->render('AcbbBundle:Default:redirectOld.html.twig');
    }

}
