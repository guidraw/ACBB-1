<?php

namespace AdminBundle\Controller;


use AcbbBundle\Entity\Media;
use AcbbBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class NewController extends Controller
{

    public function addnewAction(Request $request)
    {
        $media = new Media();
        $new = new News();

        $form = $this->get('form.factory')->createBuilder(FormType::class, array($new,$media))
            ->add('name',     TextType::class, array('label' => 'Titre'))
            ->add('author',     EntityType::class, array(
                'class' => 'AcbbBundle:User',
                'choice_label'  =>  'username',
            ))
            ->add('category',     EntityType::class, array(
                'class' => 'AcbbBundle:Category',
                'choice_label'  =>  'name',
            ))
            ->add('date', DateType::class, array('label' => 'Date de pub'))
            ->add('description',     TextType::class)
            ->add('content',     TextareaType::class, array('label' => 'Contenue'))
            ->add('medias',     FileType::class, array('label' => 'photo'))
            ->add('valider',      SubmitType::class)
            ->getForm()
        ;

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $file1 = $file = $form['medias']->getData();
            $foto = $this->fileAction($em,$file1,$media);


            $new->setName($form['name']->getData());
            $new->setAuthor($form['author']->getData());
            $new->addCategory($form['category']->getData());
            $new->setMedia($foto);
            $new->setUrl('localhost/actualites');
            $new->setPublicationDate($form['date']->getData());
            $new->setContent($form['content']->getData());
            $new->setDescription($form['description']->getData());
            $new->setCreateDate(new \DateTime());

            $em->persist($new);
            $em->flush();
            return $this->redirectToRoute('admin_homepage');
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
