<?php

namespace Smg\MenuBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('title')
            ->add('published')
        ;
    }

    public function getName()
    {
        return 'smg_menubundle_menutype';
    }
}
