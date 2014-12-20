<?php

namespace remiii\MapBundle\Form\Type ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface ;
use Symfony\Component\OptionsResolver\OptionsResolverInterface ;

class SpotPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photo', 'file', array(
            'data_class' => null,
            'required' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'remiii\GlobalBundle\Entity\SpotPhoto',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'spotPhoto';
    }
}

