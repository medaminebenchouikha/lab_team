<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PersonneController
 * @package AppBundle\Controller
 * @Route("/personne")
 */
class PersonneController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('AppBundle:Personne');

        $personnes = $repository->findAll();

        /*
        $personnes = $repository->findBy(
          array('age'=>array(28,30)),
            array('age'=>'desc'),
            10,0
        );
        */

        //$personnes = $repository->findByNom('Ahmed');

       // $personnes = $repository->getPersonneByAgeInterval(28,30);

        return $this->render('@App/Personne/list.html.twig', array(
            'personnes'=>$personnes
        ));
    }

    /**
     * @Route("/add/{nom}/{prenom}/{age}",requirements={"age": "\d+"})
     */
    public function addAction($nom,$prenom,$age)
    {
        $personne = new Personne($nom,$prenom,$age);
        $em= $this->getDoctrine()->getManager();
        $em->persist($personne);
        $em->flush();
         return $this->forward('AppBundle:Personne:list');
         /*
        return $this->render('@App/Personne/add.html.twig', array(
            // ...
        ));
         */
    }

    /**
     * @Route("/delete/{personne}")
     */
    public function deleteAction(Request $request,Personne $personne=null)
    {
        if(!$personne){
            $request->getSession()->getFlashBag()->add('error','Personne Not Found!');
        }
        else{
            $em = $this->getDoctrine()->getManager();
            $em->remove($personne);
            $em->flush();
        }

        return $this->forward('AppBundle:Personne:list');
        /*
        return $this->render('AppBundle:Personne:delete.html.twig', array(
            // ...
        ));
        */
    }

    /**
     * @Route("/update/{personne}",name ="updatePersonne")
     */
    public function updateAction(Request $request, Personne $personne=null)
    {
        if( $personne ) {
            if ($personne->getAge() > 10) {
            $personne->setAge($personne->getAge() - 10);
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();
            }
            else
                $request->getSession()->getFlashBag()->add('error','You are still young');

        } else {
            $request->getSession()->getFlashBag()->add('error','personne not found!');
        }

        return $this->forward('AppBundle:Personne:list');

        /*
        return $this->render('AppBundle:Personne:update.html.twig', array(
            // ...
        ));
        */
    }

    /**
     * @Route("/get/{id}")
     */
    public  function  getPersonneAction(Personne $personne=null){
        /*
        $repository=$this->getDoctrine()->getRepository('AppBundle:Personne');
        $personne = $repository->find($id);
        */

        $personnes = array($personne);

        return $this->render('@App/Personne/list.html.twig',array(
            'personnes' => $personnes
        ));
    }

    /**
     * @Route("/irrigate")
     */
    public  function  irrigateAction() {
        $personnes = array(
            new Personne('nomFake1','prenomFake1',35),
            new Personne('nomFake2','prenomFake2',25),
            new Personne('nomFake3','prenomFake3',15),
            new Personne('nomFake4','prenomFake',45),
        );

        $em = $this->getDoctrine()->getManager();

        foreach ($personnes as $personne){
            $em->persist($personne);
        }
        $em->flush();

       return $this->forward('AppBundle:Personne:list');
    }

}
