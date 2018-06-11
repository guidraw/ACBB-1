<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('AdminBundle:Default:addteam.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
