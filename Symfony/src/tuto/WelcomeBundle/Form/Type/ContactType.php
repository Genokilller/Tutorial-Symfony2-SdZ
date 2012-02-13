<?php

namespace tuto\WelcomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactType extends AbstractType
{
    private $class;
    
    public function __construct($class)
    {
        $this->class = $class;
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('email', 'email')
                ->add('subject', 'text')
                ->add('content', 'textarea');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => $this->class,
        );
    }

    public function getName()
    {
        return 'Contact';
    }
}