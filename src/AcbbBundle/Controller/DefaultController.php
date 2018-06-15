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

        $matches = $repoMatch->findBy([],[],2);

        $repoNew = $em->getRepository('AcbbBundle:News');

        $new = $repoNew->findBy([],['id'=>'DESC'],1);


        return $this->render('AcbbBundle:Default:index.html.twig', array(
            'matches'=> $matches,
            'new'=>$new
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
