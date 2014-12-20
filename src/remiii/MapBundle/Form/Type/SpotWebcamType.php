<?php

namespace remiii\MapBundle\Form\Type ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface ;
use Symfony\Component\OptionsResolver\OptionsResolverInterface ;

class SpotWebcamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url', 'text', array(
            'attr' => array(
                'placeholder' => 'toot.com'
            ),
            'required' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'remiii\GlobalBundle\Entity\SpotWebcam',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'spotWebcam';
    }
}

