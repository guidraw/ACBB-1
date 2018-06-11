<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function adduserAction(Request $request)
    {
        $user = new User();

        $form = $this->get('form.factory')->createBuilder(FormType::class, $user)
            ->add('username',     TextType::class)
            ->add('email',     TextType::class)
            ->add('roles',     TextType::class)
            ->add('status',     TextType::class)
            ->add('placeBirth',     TextType::class)
            ->add('job',     TextType::class)
            ->add('jobPhone',     TextType::class)
            ->add('address',     TextType::class)
            ->add('photo',    FileType::class)
            ->add('nationality',     TextType::class)
            ->add('familySituation',     TextType::class)
            ->add('team',     TextType::class)
            ->add('valider',      SubmitType::class)
            ->getForm()
        ;

        return $this->render('AdminBundle:Default:adduser.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
