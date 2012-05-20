<?php

namespace Seo\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder,$options);

        $builder
            ->add('firstName')
            ->add('lastName')
        ;
    }

    public function getName()
    {
        return 'seo_user_registration';
    }
}
