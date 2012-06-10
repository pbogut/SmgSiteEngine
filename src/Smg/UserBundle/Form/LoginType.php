<?php

namespace Smg\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('_username', 'text', array(
                'label' => 'Użytkownik',
                'attr' => array(
                    'name' => '_username'
                )
            ))
            ->add('_password', 'password', array(
                'label' => 'Hasło',
                'attr' => array(
                    'id' => 'password',
                    'name' => '_password'
                )
            ))
            
            //->add('updated')
        ;
    }

    public function getName()
    {
        return 'smg_userbundle_logintype';
    }
}
