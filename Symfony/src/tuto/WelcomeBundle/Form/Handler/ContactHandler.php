<?php

namespace tuto\WelcomeBundle\Form\Handler;

use Symfony\Component\Form\Form;
use tuto\WelcomeBundle\Form\Model\Contact;
use Symfony\Component\HttpFoundation\Request;

/**
 * The ContactHandler.
 * Use for manage your form submitions
 *
 * @author Vincent Paulin
 */
class ContactHandler
{
    protected $request;
    protected $form;
    protected $mailer;

    /**
     * Initialize the handler with the form and the request
     *
     * @param Form $form
     * @param Request $request
     * @param $mailer
     * 
     */
    public function __construct(Form $form, Request $request, $mailer)
    {
        $this->form = $form;
        $this->request = $request;
        $this->mailer = $mailer;
    }

    /**
     * Process form
     *
     * @return boolean
     */
    public function process()
    {
        // Check the method
        if ('POST' == $this->request->getMethod())
        {
            // Bind value with form
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {

                $contact = $this->form->getData();
                $this->onSuccess($contact);

                return true;
            }
        }

        return false;
    }

    /**
     * Send mail on success
     * 
     * @param Contact $contact
     * 
     */
    protected function onSuccess(Contact $contact)
    {
        $message = \Swift_Message::newInstance()
                    ->setContentType('text/html')
                    ->setSubject($contact->getSubject())
                    ->setFrom($contact->getEmail())
                    ->setTo('xxxxx@gmail.com')
                    ->setBody($contact->getContent());

        $this->mailer->send($message);
    }
}
