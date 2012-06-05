<?php

namespace Smg\MenuBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('position')
            ->add('title')
            ->add('targetUrl')
            ->add('published',null,  array('required' => false))
            ->add('menu', 'entity', array('class' => 'SmgMenuBundle:Menu'))
        ;
    }

    public function getName()
    {
        return 'smg_menubundle_itemtype';
    }
}
