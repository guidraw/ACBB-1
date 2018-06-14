<?php

namespace AcbbBundle\Controller;

use AcbbBundle\Entity\Country;
use AcbbBundle\Entity\User;
use AcbbBundle\Entity\Address;
use AcbbBundle\Entity\Media;
use AcbbBundle\Entity\Status;
use AcbbBundle\Entity\Membership;
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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InscriptionController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = new User();
        $address = new Address();
        $media = new Media();
        $membre = new Membership();



        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, array($user,$address,$media,
            $membre));

        $formBuilder
            ->add('username',     TextType::class, array('label' => 'Prénom / Nom *'))
            ->add('email',     EmailType::class, array('label' => 'Email *'))
            ->add('gender',     ChoiceType::class, array(
                'choices' => array(
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ),
                'expanded' => true,
                'label' => 'Sexe *'))
            ->add('password',     PasswordType::class, array('label' => 'Mot de pass *'))
            ->add('photo',FileType::class, array('label' => 'Photo de vous *'))
            ->add('dateBirth',     DateType::class,array(
                'label' => 'Date du naissance *',
                'years' => range(date('Y')-50, date('Y'))

            ))
            ->add('jobPhone',     TextType::class,array('label' => 'Tel. portable *'))
            /*tab nationality*/
            ->add('nationality',      EntityType::class, array(
                'label' => 'Nationnalité *',
                'class' => 'AcbbBundle:Nationality',
                'choice_label'  =>  'name',
            ))
            /*tab address*/
            ->add('number',     TextType::class,array('label' => 'Numéro *'))
            ->add('street',     TextType::class,array('label' => 'Rue *'))
            ->add('zipCode',     TextType::class,array('label' => 'Code postal *'))
            ->add('city',     TextType::class,array('label' => 'Ville *'))
            /*tab price*/
            ->add('tarif',     EntityType::class, array(
                'label' => 'Type license *',
                'class' => 'AcbbBundle:Price',
                'choice_label'  =>  'name',
            ))
            /*tab category*/
            ->add('category',     EntityType::class, array(
                'label' => 'Categorie *',
                'class' => 'AcbbBundle:Category',
                'choice_label'  =>  'name',
            ))
            /*tab insurance*/
            ->add('insurance',     ChoiceType::class, array(
                'choices' => array(
                    'Garantie de base A (0€)' => 1,
                    'Option B (15,91€)' => 2,
                    'Option C (21,56€)' => 3
                ),
                'expanded' => true,
                'label' => 'Assurance'))
            /*tab membership*/
            ->add('emergency',CheckboxType::class, array(
                'label'    => 'Urgences',
                'required' => false,
            ))
            ->add('medicamentAllergy',     TextType::class, array('required' => false))
            ->add('antidoping',CheckboxType::class, array(
                'label'    => 'Antidopage',
                'required' => false,
            ))
            ->add('trip',CheckboxType::class, array(
                'label'    => 'Déplacements',
                'required' => false,
            ))
            ->add('imageRight',CheckboxType::class, array(
                'label'    => 'Droits à l\'image',
                'required' => false,
            ))
            ->add('rules',CheckboxType::class, array(
                'label'    => 'Règlement intérieur *',
                'required' => true,
            ))
            ->add('valider',     SubmitType::class, array('label' => 'Terminer l\'inscription'))
        ;

        $form = $formBuilder->getForm();


//        if($request->isMethod('POST')&& $form->handleRequest($request)->isValid()){
//            return new Response(json_encode($form->getData()));
//        }


        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $file = $form['photo']->getData();

            $em = $this->getDoctrine()->getManager();

            $insurrance = $em->getRepository('AcbbBundle:Insurance')->findOneById($form['insurance']->getData());
            $category = $em->getRepository('AcbbBundle:Category')->findOneById($form['category']->getData());
            $price = $em->getRepository('AcbbBundle:Price')->findOneById($form['tarif']->getData());

            //upload fichier en ligne et BD
            $photo = $this->fileAction($em,$file,$media);
            //insérer l'adresse
            $place = $this->addressAction($em,$address,$form);

            //insérer user
            $user->setAddress($place);
            $user->setPhoto($photo);
            $user->setGender($form['gender']->getData());
            $user->setEmail($form['email']->getData());
            $user->setDateBirth($form['dateBirth']->getData());
            $user->setPassword($form['password']->getData());
            $user->setUsername($form['username']->getData());
            $user->setJobPhone($form['jobPhone']->getData());
            $user->setNationality($form['nationality']->getData());

            $membre->setInsurance($insurrance);
            $membre->setPrice($price);
            $membre->setEmergency($form['emergency']->getData() == false?0:1);
            $membre->setCategory($form['category']->getData() == false?0:1);
            $membre->setMedicamentAllergy($form['medicamentAllergy']->getData());
            $membre->setAntidoping($form['antidoping']->getData() == false?0:1);
            $membre->setTrip($form['trip']->getData() == false?0:1);
            $membre->setImageRight($form['imageRight']->getData() == false?0:1);
            $membre->setRules(1);

            $em->persist($user);
            $em->persist($membre);
            $em->flush();
        }

        return $this->render('AcbbBundle:Default:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }

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