<?php

namespace Seo\Bundle\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('is_active')
            ->add('url')
            ->add('title')
            ->add('description')
        ;
    }

    public function getName()
    {
        return 'seo_bundle_pagebundle_pagetype';
    }
}
