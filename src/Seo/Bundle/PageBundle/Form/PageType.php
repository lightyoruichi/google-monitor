<?php

namespace Seo\Bundle\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('phrases', 'collection', array(
                'type' => new PhraseType(),
                'allow_add' => true,
                'by_reference' => false,
            ))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Seo\Bundle\PageBundle\Entity\Page',
        );
    }

    public function getName()
    {
        return 'seo_bundle_pagebundle_pagetype';
    }
}
