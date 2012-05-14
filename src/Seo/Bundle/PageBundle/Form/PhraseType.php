<?php

namespace Seo\Bundle\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PhraseType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('phrase')
        ;
    }

    public function getName()
    {
        return 'seo_bundle_pagebundle_phrasetype';
    }
}
