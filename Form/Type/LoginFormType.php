<?php

namespace Spomky\CoovachilliBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username','text', array(
            'label' => 'form.username',
            'translation_domain' => 'SpomkyCoovachilliBundle',
        ));
        $builder->add('password', 'password', array(
            'label' => 'form.password',
            'translation_domain' => 'SpomkyCoovachilliBundle',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Spomky\CoovachilliBundle\Form\Model\Login'
        ));
    }

    public function getName()
    {
        return 'spomky_coovachilli_login';
    }
}
