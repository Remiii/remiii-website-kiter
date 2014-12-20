<?php

namespace remiii\MapBundle\Form\Type ;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use remiii\MapBundle\Form\Type\SpotPhotoType ;
use remiii\MapBundle\Form\Type\SpotWebcamType ;

// TODO

class SpotType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('x', 'number', array(
                'attr' => array(
                    'placeholder' => '1.567'
                )
            ))
            ->add('y', 'number', array(
                'attr' => array(
                    'placeholder' => '34.456'
                )
            ))
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => 'Monkey beach',
                    'pattern'     => '.{3,}' //minlength
                )
            ))
            ->add('description', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Your description...',
                ),
                'required' => false
            ))
            ->add('sport', 'choice',  array(
                'choices' => array(
                    'kitesurf'   => 'kitesurf',
                    'buggy'   => 'buggy',
                    'kite'   => 'kite',
                    'montainborad'   => 'montainboard',
                    'snowkite'  => 'snowkite',
                ),
                'expanded' => true,
                'multiple' => true,
                'widget_type' => 'inline',
                'required' => false
            ))
            ->add('sportExtra', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Extra info...'
                ),
                'required' => false
            ))
            ->add('wind', 'choice',  array(
                'choices' => array(
                    'n'   => 'n',
                    's'   => 's',
                    'e'   => 'e',
                    'w'   => 'w',
                    'ne'  => 'ne',
                    'nw'  => 'nw',
                    'se'  => 'se',
                    'sw'  => 'sw',
                ),
                'expanded' => true,
                'multiple' => true,
                'widget_type' => 'inline',
                'required' => false
            ))
            ->add('windExtra', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Extra info...'
                ),
                'required' => false
            ))
            ->add('tide', 'choice',  array(
                'choices' => array(
                    'low-tide'   => 'low tide',
                    'mid-tide'   => 'mid tide',
                    'high-tide'   => 'high tide',
                    'in-coming'   => 'in coming',
                    'out-going'  => 'out going',
                    'n-a' => 'n/a',
                ),
                'expanded' => true,
                'multiple' => true,
                'widget_type' => 'inline',
                'required' => false
            ))
            ->add('tideExtra', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Extra info...'
                ),
                'required' => false
            ))
            ->add('condition', 'choice',  array(
                'choices' => array(
                    'waves'   => 'waves',
                    'choppy'   => 'choppy',
                    'flat-water'   => 'flat water',
                    'shallow'   => 'shallow',
                ),
                'expanded' => true,
                'multiple' => true,
                'widget_type' => 'inline',
                'required' => false
            ))
            ->add('conditionExtra', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Extra info...'
                ),
                'required' => false
            ))
            ->add('hazard', 'choice',  array(
                'choices' => array(
                    'currents'   => 'currents',
                    'ships-boats'   => 'ships/boats',
                    'reefs-coral'   => 'reefs/coral',
                    'groynes'   => 'groynes',
                    'rocks-stones'   => 'rocks/stones',
                    'stakes'   => 'stakes',
                    'trees'   => 'trees',
                    'road'   => 'road',
                    'power-lines'   => 'power lines',
                    'small-launch-area'   => 'small launch area',
                    'swimmers'   => 'swimmers',
                    'none'   => 'none',
                ),
                'expanded' => true,
                'multiple' => true,
                'widget_type' => 'inline',
                'required' => false
            ))
            ->add('hazardExtra', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Extra info...'
                ),
                'required' => false
            ))
            ->add('rule', 'choice',  array(
                'choices' => array(
                    'restricted-zones'   => 'restricted zones',
                    'time-restrictions'   => 'time restrictions',
                    'fees'   => 'fees',
                    'none'   => 'none',
                ),
                'expanded' => true,
                'multiple' => true,
                'widget_type' => 'inline',
                'required' => false
            ))
            ->add('ruleExtra', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Extra info...'
                ),
                'required' => false
            ))
            ->add('surface', 'choice',  array(
                'choices' => array(
                    'water'   => 'water',
                    'sand'   => 'sand',
                    'grass'   => 'grass',
                    'concrete'   => 'concrete',
                ),
                'expanded' => true,
                'multiple' => true,
                'widget_type' => 'inline',
                'required' => false
            ))
            ->add('surfaceExtra', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Extra info...'
                ),
                'required' => false
            ))
            /*->add('spotPhotos', new SpotPhotoType(), array(
                'data_class' => null,
                'required' => false
            ))*/
            ->add('spotWebcams', 'collection', array(
                'type' => new SpotWebcamType(),
                'required' => false
            ->add('ok', 'submit', array('attr' => array('class' => 'btn btn-primary pull-right')));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'remiii\GlobalBundle\Entity\Spot',
            'csrf_protection' => false,
        ));
    }

    public function getName ( )
    {
        return 'spot' ;
    }

}
