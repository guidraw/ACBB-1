<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{

    public function addteamAction(Request $request)
    {
        $team = new Team();

        $form = $this->get('form.factory')->createBuilder(FormType::class, $team)
            ->add('name',     TextType::class)
            ->add('category',     TextType::class)
            ->add('club',     TextType::class)
            ->add('status',     TextType::class)
            ->add('medias',     TextType::class)
            ->add('users',    TextType::class)
            ->add('valider',      SubmitType::class)
            ->getForm()
        ;


/*        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
            return $this->redirectToRoute('admin_homepage');
        }*/
        if($request->isMethod('POST')){
            return new Response("data: ".$request);
        }

        return $this->render('AdminBundle:Default:addteam.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
