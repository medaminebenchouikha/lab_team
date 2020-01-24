<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Services\UtilsService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request,UtilsService $utilsService)
    {
       $session = $request->getSession();

       $straleatoir = $utilsService->getRandomString(5);

        $utilsService->sendMail('Bonjour medamine','med.amine.ben.chouikha@gmail.com','Bonjour Symfony');

        // replace this example code with whatever you need

        if($session->has('maVariable')){
            $maVariable = $session->get('maVariable');

            echo 'sessikon existe '.$maVariable;
        }
        else {
            $session->set('maVariable','AMINE');
            echo 'i insert a new value of session';
        }
       return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);



       //return $this->forward('AppBundle:Default:premier');
    }



    /**
     * @Route("premier/{_locale}/{nom}/{prenom}/{age}", name="premier",
     *     requirements={
     *     "age" : "\d+",
     *     "_locale" : "ar|en|fr",
     *     "_method" : "GET"
     * }
     * )
     */
    public function premierAction($nom,$prenom){

        return $this->render('@App/premier.html.twig',
            array(
                'nom'=>$nom,
                'prenom'=>$prenom
            ));


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/heritage")
     */
    public function heritageAction(){
        return $this->render('@App/heritage.html.twig');
    }
}
