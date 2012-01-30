<?php
namespace tuto\WelcomeBundle\Form\Callbacks;

use Symfony\Component\Validator\ExecutionContext;
use tuto\WelcomeBundle\Form\Model\Contact;

class ContactValidator
{
    static public function isEmailValid(Contact $contact, ExecutionContext $context)
    {
        // somehow you have an array of "fake email"
        $fakeEmails = array('test@test.com', 'toto@titi.com', 'xxx@xxx.be');

        // check if the name is actually a fake email
        if (in_array($contact->getEmail(), $fakeEmails)) {
            $propertyPath = $context->getPropertyPath() . '.email';
            $context->setPropertyPath($propertyPath);
            $context->addViolation('Tu ne te moquerais pas un peu de moi avec cet email ?', array(), null);
        }
    }
}
