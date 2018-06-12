<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function adduserAction(Request $request)
    {
        $user = new User();

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user);

        $formBuilder
            ->add('username',     TextType::class)
            ->add('email',     EmailType::class)
            ->add('status',     EntityType::class, array(
                'class' => 'AcbbBundle:Status',
                'choice_label'  =>  'name',
            ))
            ->add('placeBirth',     TextType::class)
            ->add('job',     TextType::class)
            ->add('jobPhone',     TextType::class)
            ->add('address',     EntityType::class, array(
                'class' => 'AcbbBundle:Address',
                'choice_label'  =>  'city',
            ))
            ->add('nationality',      EntityType::class, array(
                'class' => 'AcbbBundle:Nationality',
                'choice_label'  =>  'name',
            ))
            ->add('familySituation',     EntityType::class, array(
                'class' => 'AcbbBundle:Status',
                'choice_label'  =>  'name',
            ))
            ->add('team',     EntityType::class, array(
                'class' => 'AcbbBundle:Team',
                'choice_label'  =>  'name',
            ))
            ->add('valider',      SubmitType::class)
        ;

        $form = $formBuilder->getForm();

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render('AdminBundle:Default:adduser.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
