<?php

namespace tuto\WelcomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use tuto\WelcomeBundle\Form\ContactType;

class ContactController extends Controller
{

   /**
    * Contact
    *
    * @author Vincent Paulin
    */
    public function indexAction()
    {
        $form = $this->get('form.factory')->create(new ContactType());

         // Get the request
        $request = $this->get('request');

        // Check the method
        if ($request->getMethod() == 'POST')
        {
            // Bind value with form
            $form->bindRequest($request);

            $data = $form->getData();

            // Valid form
            if ($form->isValid())
            {
                $message = \Swift_Message::newInstance()
                    ->setContentType('text/html')
                    ->setSubject($data['subject'])
                    ->setFrom($data['email'])
                    ->setTo('xxxxx@gmail.com')
                    ->setBody($data['content']);

                $this->get('mailer')->send($message);

                // Launch the message flash
                $this->get('session')->setFlash('notice', 'Merci de nous avoir contacté, nous répondrons à vos questions dans les plus brefs délais.');
            }
        }

        return $this->render('tutoWelcomeBundle:Contact:index.html.twig',
                array(
                    'form' => $form->createView(),
                    'hasError' => $request->getMethod() == 'POST' && !$form->isValid()
                ));

    }
}
