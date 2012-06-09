<?php

namespace Smg\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('author', null, array(
                'label' => 'Autor'
            ))
            ->add('title', null, array(
                'label' => 'Tytuł',
                'attr' => array(
                    'class' => 'span8',
                )
            ))
            ->add('content', null, array(
                'label' => 'Tekst',
                'attr' => array(
                    'class' => 'input-xlarge span8',
                    'rows' => '12'
                )
            ))
            ->add('tags', 'text', array(
                'label' => 'Tagi',
                'attr' => array(
                    'class' => 'span8'
                )
            ))
            //->add('updated')
        ;
    }

    public function getName()
    {
        return 'smg_newsbundle_newstype';
    }
}
