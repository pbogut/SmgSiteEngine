<?php

namespace Smg\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('author')
            ->add('content', null, array(
                'attr' => array(
                    'class' => 'input-xlarge',
                    'rows' => '7'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'smg_newsbundle_commenttype';
    }
}
