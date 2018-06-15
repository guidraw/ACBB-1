<?php

namespace AdminBundle\Controller;


use AcbbBundle\Entity\Media;
use AcbbBundle\Entity\Album;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class MediaController extends Controller
{

    public function addmediaAction(Request $request)
    {
        $media = new Media();
        $album = new Album();

        $form = $this->get('form.factory')->createBuilder(FormType::class, array($album,$media))
            ->add('name',     TextType::class, array('label' => 'Nom d\'Album'))
            ->add('author',     TextType::class, array('label' => 'auteur'))
            ->add('photographer',     TextType::class, array('label' => 'photographe'))
            ->add('category',     EntityType::class, array(
                'class' => 'AcbbBundle:Category',
                'choice_label'  =>  'name',
            ))
            ->add('season',     EntityType::class, array(
                'class' => 'AcbbBundle:Season',
                'choice_label'  =>  'name',
            ))
            ->add('medias',     FileType::class, array('label' => 'photo'))
            ->add('valider',      SubmitType::class)
            ->getForm()
        ;

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $file1 = $file = $form['medias']->getData();
            $foto = $this->fileAction($em,$file1,$media);


            $album->setName($form['name']->getData());
            $album->setAuthor($form['author']->getData());
            $album->setPhotographer($form['photographer']->getData());
            $album->addCategory($form['category']->getData());
            $album->setSeason($form['season']->getData());
            $album->addMedia($foto);
            $album->setUrl('localhost/album');
            $album->setPublicationDate(new \DateTime());

            $em->persist($album);
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
