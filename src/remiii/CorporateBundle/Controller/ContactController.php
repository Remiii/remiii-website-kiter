<?php

namespace remiii\CorporateBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Request ;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template ;

use remiii\CorporateBundle\Form\Type\ContactType ;
use remiii\GlobalBundle\Entity\InboundContact ;

class ContactController extends Controller
{

    /**
     * @Template
     */
    public function contactAction ( Request $request )
    {

        $inboundContact = new InboundContact ( ) ;
        $inboundContact -> setIp ( $request -> getClientIp ( ) ) ;
        $form = $this -> createForm ( new ContactType ( ) , $inboundContact );

        if ( $request -> isMethod ( 'POST' ) )
        {

            $form -> handleRequest ( $request ) ;

            if ( $form -> isValid ( ) )
            {

                $em = $this -> getDoctrine ( ) -> getManager ( ) ;

                $inboundContact -> setName ( $form -> get ( 'name' ) -> getData ( ) ) ;
                $inboundContact -> setEmail ( $form -> get ( 'email' ) -> getData ( ) ) ;
                $inboundContact -> setSubject ( $form -> get ( 'subject' ) -> getData ( ) ) ;
                $inboundContact -> setMessage ( $form -> get ( 'message' ) -> getData ( ) ) ;

                // Email to sender
                $message = \Swift_Message::newInstance ( )
                    -> setSubject ( $form -> get ( 'subject' ) -> getData ( ) )
                    -> setFrom ( $this -> container -> getParameter ( 'email_noreply' ) )
                    -> setTo ( $form -> get ( 'email' ) -> getData ( ) )
                    -> setReplyTo ( $this -> container -> getParameter ( 'email_noreply' ) )
                    -> setcontenttype ( 'text/html' )
                    -> setBody (
                        $this -> renderView (
                            'remiiiCorporateBundle:Contact:emailContactToSender.html.twig' ,
                            array (
                                'name' => $form -> get ( 'name' ) -> getData ( ) ,
                                'message' => $form -> get ( 'message' ) -> getData ( )
                            )
                        )
                    ) ;
                $this -> get ( 'mailer' ) -> send ( $message ) ;

                // Email to recipient
                $message = \Swift_Message::newInstance ( )
                    -> setSubject ( '[ContactForm]' . $form -> get ( 'subject' ) -> getData ( ) )
                    -> setFrom ( $form -> get ( 'email' ) -> getData ( ) )
                    -> setTo ( $this -> container -> getParameter ( 'email_admin' ) )
                    -> setReplyTo ( $this -> container -> getParameter ( 'email_noreply' ) )
                    -> setcontenttype ( 'text/html' )
                    -> setBody (
                        $this -> renderView (
                            'remiiiCorporateBundle:Contact:emailContactToRecipient.html.twig' ,
                            array (
                                'ip' => $request -> getClientIp ( ) ,
                                'name' => $form -> get ( 'name' ) -> getData ( ) ,
                                'message' => $form -> get ( 'message' ) -> getData ( )
                            )
                        )
                    ) ;
                $this -> get ( 'mailer' ) -> send ( $message ) ;

                $em -> persist ( $inboundContact ) ;
                $em -> flush ( ) ;

                $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Your email has been sent! Thanks!' ) ;

                return $this -> redirect ( $this -> get ( 'router' ) -> generate ( 'remiii_corporate_contact' ) ) ;

            }
            else
            {

                $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Something was wrong! :-(' ) ;

            }

        }

        return array ( 'form' => $form->createView ( ) ) ;

    }

}

