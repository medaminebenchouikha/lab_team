<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TacheController
 * @package AppBundle\Controller
 * @Route("/tache")
 */
class TacheController extends Controller
{


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if(! $session->has('mesTaches')){
            $mesTaches = array(
                'lundi'=>'php',
                'mardi'=>'CSS'
            );
            $session->set('mesTaches',$mesTaches);
            $session->getFlashBag()->add('success','init my task');
        } else {
            $mesTaches = $session->get('mesTaches');
        }
        return $this->render('@App/Taches/index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/add/{key}/{value}",defaults={
          "value":"I don't have anythings",
          "key":"dimanche"
          })
     */
    public  function  addAction(Request $request,$key,$value) {
        $session = $request->getSession();
        if($session->has('mesTaches')) {
            $mesTaches = $session->get('mesTaches');
            $mesTaches[$key]= $value;
            $session->set('mesTaches',$mesTaches);
            $message = 'tache '.$key.' added successefuly';
            $session->getFlashBag()->add('success',$message);
        }
        else {
            $message ='the tasks must been init before added!';
            $session->getFlashBag()->add('error',$message);
        }
       // return $this->render('@App/Taches/index.html.twig');
        return $this->forward('AppBundle:Tache:index');
    }


}
