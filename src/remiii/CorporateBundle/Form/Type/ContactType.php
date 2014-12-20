<?php

namespace remiii\CorporateBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => 'Mohandas Gandhi',
                    'pattern'     => '.{2,}' //minlength
                )
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'gandhi@gmail.com'
                )
            ))
            ->add('subject', 'text', array(
                'attr' => array(
                    'placeholder' => 'The subject of your message',
                    'pattern'     => '.{3,}' //minlength
                )
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10,
                    'placeholder' => 'Your message...'
                )
            ))
            ->add('sendMessage', 'submit', array('attr' => array('class' => 'btn btn-primary pull-right')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /*$collectionConstraint = new Collection(array(
            'name' => array(
                new NotBlank(array('message' => 'Name should not be blank.')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Email should not be blank.')),
                new Email(array('message' => 'Invalid email address.'))
            ),
            'subject' => array(
                new NotBlank(array('message' => 'Subject should not be blank.')),
                new Length(array('min' => 3))
            ),
            'message' => array(
                new NotBlank(array('message' => 'Message should not be blank.')),
                new Length(array('min' => 5))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));*/

        $resolver->setDefaults(array(
            'data_class' => 'remiii\GlobalBundle\Entity\InboundContact',
            'csrf_protection' => true,
        ));

    }

    public function getName()
    {
        return 'contact';
    }

}

