<?php

namespace tuto\WelcomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomepageController extends Controller
{

    public function indexAction()
    {
        $this->get('session')->setFlash('notice', 'Bienvenue à toi '.$this->get('session')->get('user_name').' !');

        return $this->render('tutoWelcomeBundle:Homepage:index.html.twig');
    }

    public function whoAmIAction($name)
    {
        # get the session
        $session = $this->get('session');

        # store the user'name in the session
        $session->set('user_name', $name);

        return $this->redirect($this->container->get('router')->generate('tutoWelcomeBundle_homepage'));
    }
}
