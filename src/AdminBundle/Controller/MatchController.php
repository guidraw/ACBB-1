<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MatchController extends Controller
{

    public function addmatchAction(Request $request)
    {

        $match = new Match();

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $match);

        $formBuilder
            ->add('date',      DateType::class, array('label' => 'Date du match'))
            ->add('team1',     EntityType::class, array(
                'class' => 'AcbbBundle:Team',
                'choice_label'  =>  'name',
            ))
            ->add('team2',     EntityType::class, array(
                'class' => 'AcbbBundle:Team',
                'choice_label'  =>  'name',
            ))
            ->add('season',     EntityType::class, array(
                'class' => 'AcbbBundle:Season',
                'choice_label'  =>  'name',
            ))
            ->add('address',     EntityType::class, array(
                'class' => 'AcbbBundle:Address',
                'choice_label'  =>  'city',
            ))
            ->add('category',     EntityType::class, array(
                'class' => 'AcbbBundle:Category',
                'choice_label'  =>  'name'
            ))
            ->add('status',     EntityType::class, array(
                'class' => 'AcbbBundle:Status',
                'choice_label'  =>  'name',
            ))
            ->add('scoreTeam1',     TextType::class)
            ->add('scoreTeam2',     TextType::class)
            ->add('valider',      SubmitType::class)
        ;

        $form = $formBuilder->getForm();

    if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
//        $match->setAddress(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($match);
        $em->flush();
        return $this->redirectToRoute('admin_homepage');
    }
//        if($request->isMethod('POST')){
//            return new Response("data: ".$request);
//        }

        return $this->render('AdminBundle:Default:addmatch.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
