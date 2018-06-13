<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\User;
use AcbbBundle\Entity\Address;
use AcbbBundle\Entity\Media;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;

class UserController extends Controller
{

    public function adduserAction(Request $request)
    {
        $user = new User();
        $address = new Address();
        $media = new Media();

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, array($user,$address,$media));

        $formBuilder
            ->add('username',     TextType::class)
            ->add('email',     EmailType::class)
            ->add('photo',FileType::class)
            ->add('status',     EntityType::class, array(
                'class' => 'AcbbBundle:Status',
                'choice_label'  =>  'name',
            ))
            ->add('placeBirth',     TextType::class)
            ->add('job',     TextType::class)
            ->add('jobPhone',     TextType::class)
            ->add('number',     TextType::class)
            ->add('street',     TextType::class)
            ->add('zip_code',     TextType::class)
            ->add('city',     TextType::class)
            ->add('nationality',      EntityType::class, array(
                'class' => 'AcbbBundle:Nationality',
                'choice_label'  =>  'name',
            ))
            ->add('familySituation',     EntityType::class, array(
                'class' => 'AcbbBundle:Status',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.id between 3 and 5');
                },
                'choice_label'  => 'name',
            ))
            ->add('team',     EntityType::class, array(
                'class' => 'AcbbBundle:Team',
                'choice_label'  =>  'name',
            ))
            ->add('valider',      SubmitType::class)
        ;

        $form = $formBuilder->getForm();

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

//            $file = $form['photo']->getData();
//            $extension = $file->guessExtension();
//            if (!$extension) {
//                $extension = 'bin';
//            }
//
//            $file->move('/web', rand(1, 99999).'.'.$extension);

            $dir = '%kernel.project_dir/web/';

//            $em = $this->getDoctrine()->getManager();
////            $media->setStatus(2);
////            $media->setLink('/web');
////            $media->setDate(new \DateTime());
////            $media->setName('user');
//            $em->persist($user);
//
////            $em->persist($media);
//            $em->flush();
            return $this->redirectToRoute('admin_homepage',$dir);
        }

        return $this->render('AdminBundle:Default:adduser.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
