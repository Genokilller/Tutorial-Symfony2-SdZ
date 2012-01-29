<?php

namespace tuto\WelcomeBundle\Entity;
use Symfony\Component\Validator\ExecutionContext;

class Contact
{
    /**
     * Email
     * @var string
     */
    protected $email;

    /**
     * Subject
     * @var string
     */
    protected $subject;

    /**
     * Content
     * @var string
     */
    protected $content;

    public function isEmailValid(ExecutionContext $context)
    {
        // somehow you have an array of "fake email"
        $fakeEmails = array('test@test.com');

        // check if the name is actually a fake email
        if (in_array($this->getEmail(), $fakeEmails)) {
            $propertyPath = $context->getPropertyPath() . '.email';
            $context->setPropertyPath($propertyPath);
            $context->addViolation('Tu ne te moquerais pas un peu de moi avec cet email ?', array(), null);
        }
    }

    public function getEmail() {
      return $this->email;
    }

    public function setEmail($email) {
      $this->email = $email;
    }

    public function getSubject() {
      return $this->subject;
    }

    public function setSubject($subject) {
      $this->subject = $subject;
    }

    public function getContent() {
      return $this->content;
    }

    public function setContent($content) {
      $this->content = $content;
    }
}