<?php

namespace AcbbBundle\Controller;

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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class InscriptionController extends Controller
{
    public function indexAction(Request $request)
    {
//       return $this->render('AcbbBundle:Default:inscription.html.twig');
        $user = new User();
        $address = new Address();
        $media = new Media();

        $choices = [
            'Homme' => 'Homme',
            'Femme' => 'Femme'
        ];

        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, array($user,$address,$media));

        $formBuilder
            ->add('username',     TextType::class, array('label' => 'Prénom / Nom *'))
            ->add('email',     EmailType::class, array('label' => 'Email *'))
            ->add('gender',     ChoiceType::class, array(
                'choices' => $choices,
                'expanded' => true,
                'label' => 'Sexe *'))
            ->add('password',     PasswordType::class, array('label' => 'Mot de pass *'))
            ->add('photo',FileType::class, array('label' => 'Photo de vous *'))
            ->add('dateBirth',     DateType::class,array('label' => 'Date du naissance *'))
            ->add('jobPhone',     TextType::class,array('label' => 'Tel. portable *'))
            ->add('number',     TextType::class,array('label' => 'Numéro *'))
            ->add('street',     TextType::class,array('label' => 'Rue *'))
            ->add('zipCode',     TextType::class,array('label' => 'Code postal *'))
            ->add('city',     TextType::class,array('label' => 'Ville *'))
            ->add('nationality',      EntityType::class, array(
                'label' => 'Nationnalité *',
                'class' => 'AcbbBundle:Nationality',
                'choice_label'  =>  'name',
            ))
            ->add('valider',      SubmitType::class, array('label' => 'Suivant'))
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
            $user->setEmail($form['email']->getData());
            $user->setDateBirth($form['dateBirth']->getData());
            $user->setPassword($form['password']->getData());
            $user->setUsername($form['username']->getData());
            $user->setJobPhone($form['jobPhone']->getData());
            $user->setNationality($form['nationality']->getData());

            $em->persist($user);
            $em->flush();

            return new Response(json_encode($file));
        }

        return $this->render('AcbbBundle:Default:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }
//
//
//        return $this->render('AdminBundle:Default:addmatch.html.twig', array(
//            'form' => $form->createView(),
//        ));

    //insérer dans BD
    public function fileAction($em,$file,$media){
        $upload = $this->container->get('acbb.image_uploader')->upload($file);


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

    public function documentAction()
    {
        return $this->render('AcbbBundle:Default:document.html.twig');
    }

    public function firstStepAction()
    {
        return $this->render('AcbbBundle:Default:firstStep.html.twig');
    }

}