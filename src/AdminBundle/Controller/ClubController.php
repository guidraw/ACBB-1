<?php

namespace AdminBundle\Controller;

use AcbbBundle\Entity\Club;
use AcbbBundle\Entity\Media;
use AcbbBundle\Entity\Address;
use AcbbBundle\Entity\Country;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ClubController extends Controller
{

    public function addclubAction(Request $request)
    {
        $club = new Club();
        $address = new Address();
        $media = new Media();

        $form = $this->get('form.factory')->createBuilder(FormType::class, array($club,$address,$media))
            ->add('name',     TextType::class, array('label' => 'Nom du club'))
            ->add('number',     TextType::class)
            ->add('street',     TextType::class)
            ->add('zipCode',     TextType::class)
            ->add('city',     TextType::class)
            ->add('medias',     FileType::class, array('label' => 'photo de l\'équipe'))
            ->add('valider',      SubmitType::class)
            ->getForm()
        ;

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $file1 = $file = $form['medias']->getData();
            $foCLub = $this->fileAction($em,$file1,$media);

            $place = $this->addressAction($em,$address,$form);

            $club->setName($form['name']->getData());
            $club->setAddress($place);
            $club->setLogoClub($foCLub);

            $em->persist($club);
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
