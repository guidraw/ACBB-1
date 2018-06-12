<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class MatchController extends Controller
{

    public function addmatchAction(Request $request)
    {

        $match = new Match();

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $match);

        $formBuilder
            ->add('date',      DateType::class)
            ->add('team1',     TextType::class)
            ->add('team2',     TextType::class)
            ->add('address',     TextType::class)
            ->add('valider',      SubmitType::class)
        ;

        /*        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
            return $this->redirectToRoute('admin_homepage');
        }*/

        $form = $formBuilder->getForm();

        return $this->render('AdminBundle:Default:addmatch.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
