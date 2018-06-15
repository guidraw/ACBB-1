<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\Country;
use AcbbBundle\Entity\User;
use AcbbBundle\Entity\Address;
use AcbbBundle\Entity\Media;
use AcbbBundle\Entity\Status;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
            ->add('gender',     ChoiceType::class, array(
                'choices' => array(
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ),
                'expanded' => true,
                'label' => 'Sexe *'))
            ->add('email',     EmailType::class)
            ->add('password',     PasswordType::class)
            ->add('photo',FileType::class)
            ->add('status',     EntityType::class, array(
                'class' => 'AcbbBundle:Status',
                'choice_label'  =>  'name',
            ))
            ->add('dateBirth',     DateType::class, array(
                'years' => range(date('Y')-50, date('Y'))
            ))
            ->add('job',     TextType::class)
            ->add('jobPhone',     TextType::class)
            ->add('number',     TextType::class)
            ->add('street',     TextType::class)
            ->add('zipCode',     TextType::class)
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
            $file = $form['photo']->getData();

            $em = $this->getDoctrine()->getManager();

            //upload fichier en ligne et BD
            $photo = $this->fileAction($em,$file,$media);
            //insérer l'adresse
            $place = $this->addressAction($em,$address,$form);

            $user->setAddress($place);
            $user->setPhoto($photo);
            $user->setGender($form['gender']->getData());
            $user->setEmail($form['email']->getData());
            $user->setDateBirth($form['dateBirth']->getData());
            $user->setPassword($form['password']->getData());
            $user->setUsername($form['username']->getData());
            $user->setJob($form['job']->getData());
            $user->setJobPhone($form['jobPhone']->getData());
            $user->setNationality($form['nationality']->getData());
            $user->setFamilySituation($form['familySituation']->getData());
            $user->setStatus($form['status']->getData());
            $user->setTeam($form['team']->getData());

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render('AdminBundle:Default:adduser.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    //insérer dans BD
    public function fileAction($em,$file,$media){
        $upload = $this->container->get('admin.image_uploader')->upload($file);


        $status = $em->getRepository(Status::class)->findOneById(2);

        $media->setStatus($status);
        $media->setLink($upload['path']);
        $media->setName($upload['fileName']);
        $media->setDate(new \DateTime());
        $em->persist($media);
        $em->flush();
        return $media;
    }

    public function addressAction($em,$address,$form){
        $country = $em->getRepository(Country::class)->findOneById(1);

        $address->setNumber($form['number']->getData());
        $address->setStreet($form['street']->getData());
        $address->setZipCode($form['zipCode']->getData());
        $address->setCity($form['city']->getData());
        $address->setCountry($country);

        $em->persist($address);
        $em->flush();
        return $address;
    }

}




