<?php

namespace AcbbBundle\Controller;


use AcbbBundle\Entity\Match;
use AcbbBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $matchRepo = $em->getRepository(Match::class);
        $matches = $matchRepo->findAll();

        $categoryRepo = $em->getRepository(Category::class);
        $categories = $categoryRepo->findAll();

        if(!$matches){
            throw $this->createNotFoundException('no found');
        }

        return $this->render('AcbbBundle:Default:teams.html.twig',array(
            'matches'=>$matches,
            'categories'=>$categories,
        ));
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
