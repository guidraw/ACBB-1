<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\Team;
use AcbbBundle\Entity\Media;
use AcbbBundle\Entity\User;
use AcbbBundle\Entity\Membership;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{

    public function addteamAction(Request $request)
    {
        $team = new Team();
        $user = new User();
        $media = new Media();
        $member = new Membership();

        $form = $this->get('form.factory')->createBuilder(FormType::class, array($team,$user,$media,$member))
            ->add('name',     TextType::class, array('label' => 'Nom de l\'équipe'))
            ->add('category',     EntityType::class, array(
                'class' => 'AcbbBundle:Category',
                'choice_label'  =>  'name',
            ))
            ->add('club',     EntityType::class, array(
                'class' => 'AcbbBundle:Club',
                'choice_label'  =>  'name',
            ))
            ->add('status',     EntityType::class, array(
                'class' => 'AcbbBundle:Status',
                'choice_label'  =>  'name',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.id between 1 and 2');
                },
            ))
            ->add('medias',     FileType::class, array('label' => 'photo de l\'équipe'))

            ->add('gamer',     EntityType::class, array(
                'class' => 'AcbbBundle:User',
                'choice_label'  =>  'username',
            ))

            ->add('valider',      SubmitType::class)
            ->getForm()
        ;

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $file1 = $file = $form['medias']->getData();
            $foTeam = $this->fileAction($em,$file1,$media);

            $team->setName($form['name']->getData());
            $team->setCategory($form['category']->getData());
            $team->setClub($form['club']->getData());
            $team->setStatus($form['status']->getData());
            $team->addUser($form['gamer']->getData());
            $team->addMedia($foTeam);

            $em->persist($team);
            $em->flush();

        }

        return $this->render('AdminBundle:Default:addteam.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    //insérer dans BD
    public function fileAction($em,$file,$media){
        $upload = $this->container->get('admin.image_uploader')->upload($file);


        $status = $em->getRepository('AcbbBundle:Status')->findOneById(2);

        $media->setStatus($status);
        $media->setLink($upload['path']);
        $media->setName($upload['fileName']);
        $media->setDate(new \DateTime());
        $em->persist($media);
        $em->flush();
        return $media;
    }

}
