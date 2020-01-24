<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Enseignant;
use AppBundle\Form\EnseignantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EnseignantController
 * @package AppBundle\Controller
 * @Route("/ensignant")
 */
class EnseignantController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/add",name="show_enseignant")
     */
    public function showFormAction()
    {
        $enseignant = new Enseignant();
        $form = $this->createForm(EnseignantType::class,$enseignant,
            array('action'=>$this->generateUrl('add_enseignant')));

        return $this->render('@App/Enseignant/add.html.twig',
                        array(
                            'form' => $form->createView()
                        )
        );
    }

    /**
     * @Route("/addensignant",name="add_enseignant")
     */
    public  function  addAction(Request $request) {
        $enseignant = new Enseignant();
        $form = $this->createForm(EnseignantType::class,$enseignant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $form['image']->getData();
            $newImageName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('enseignant_images'),$newImageName);
            $enseignant->setImage($newImageName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($enseignant);
            $em->flush();
            return $this->forward('AppBundle:Enseignant:show');

        }
        else return $this->render('@App/Enseignant/add.html.twig',array('form'=>$form->createView()));

    }

    /**
     * @Route("/list",name="list_enseignants")
     */
    public function  showAction() {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Enseignant');

        $enseignants = $repository->findAll();

        return $this->render('@App/Enseignant/list.html.twig',array('enseignants'=>$enseignants));


    }
}
