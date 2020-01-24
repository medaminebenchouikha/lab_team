<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/adduser")
     */
    public function addAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('newUserByUM');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setEmail('newUser@gmail.com');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $userManager->updateUser($user);
       // die(' user add newUserByUM');
        return $this->forward('AppBundle:Security:redirect');
    }

    /**
     * @Route("/home")
     */
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
       if($authChecker->isGranted('ROLE_ADMIN')) {
           return $this->render('@App/Security/admin_home.html.twig');
       } else if ($authChecker->isGranted('ROLE_USER')) {
           return $this->render('@App/Security/user_home.html.twig');
       }
        else
            return $this->redirectToRoute('fos_user_security_login');
    }

}
