<?php

namespace remiii\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request ;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use remiii\GlobalBundle\Entity\Spot ;
use remiii\GlobalBundle\Entity\SpotProposal ;
use remiii\MapBundle\Form\Type\SpotProposalType ;
use remiii\MapBundle\Form\Type\SpotType ;
use remiii\GlobalBundle\Entity\SpotWebcam ;

class DefaultController extends Controller
{

    /**
     * @Template
     */
    public function mapAction ( )
    {
        return array ( ) ;
    }

    /**
     * @Template
     */
    public function spotAction ( Request $request , $x , $y , $name )
    {
        $em = $this -> getDoctrine ( ) -> getManager ( ) ;
        $spot = $em -> getRepository ( 'remiiiGlobalBundle:Spot' ) -> findOneByUrl ( $x . '/' . $y . '/' . $name ) ;

        if ( $spot )
        {
            return array ( 'spot' => $spot ) ;
        }
        else
        {
            throw $this -> createNotFoundException ( 'Page introuvable' ) ;
        }
    }

    /**
     * @Template
     */
    public function spotsListAction ( )
    {
        $em = $this -> getDoctrine ( ) -> getManager ( ) ;
        $spotsList = $em -> getRepository ( 'remiiiGlobalBundle:Spot' ) -> getSpotsList ( ) ;
        return array ( 'spots' => $spotsList ) ;
    }

    /**
     *
     */
    public function spotsListGeoJsonAction ( )
    {
        $em = $this -> getDoctrine ( ) -> getManager ( ) ;
        $spotsList = $em -> getRepository ( 'remiiiGlobalBundle:Spot' ) -> findAll ( ) ;
        $prettySpotsList =
            array (
                'type' => 'FeatureCollection' ,
                'features' => array ( )
            ) ;
        foreach ( $spotsList as $key => $spot )
        {
            $prettySpotsList [ 'features' ] [ $key ] =
                array (
                    'type' => 'Feature' ,
                    'geometry' =>
                        array (
                            'type' => 'Point',
                            'coordinates' => array ( $spot->getX() , $spot->getY() )
                        ),
                    'properties' => array (

                        'title' => $spot -> getName ( ) ,
                        'description' => $spot -> getDescription ( ) ,
                        'url' => $spot -> getUrl ( ) ,
                        'sport' => $spot -> getSport ( )
                    )
                ) ;
        }

        $response = new JsonResponse ( ) ;
        $response -> setContent ( json_encode ( $prettySpotsList ) ) ;
        return $response ;
    }

    /**
     *@Template
     */
    public function spotProposalAddAction ( Request $request )
    {
        $spotProposal = new SpotProposal ( ) ;
        $spotProposal -> setIp ( $request -> getClientIp ( ) ) ;
        $form = $this -> createForm ( new SpotProposalType ( ) , $spotProposal ) ;

        if ($request->isMethod('POST'))
        {

            $form -> handleRequest ( $request ) ;

            if ( $form -> isValid ( ) )
            {

                // Email to sender
                $message = \Swift_Message::newInstance ( )
                    -> setSubject ( 'Add spot: ' . $form -> get ( 'name' ) -> getData ( ) )
                    -> setFrom ( $this -> container -> getParameter ( 'email_noreply' ) )
                    -> setTo ( $form -> get ( 'email' ) -> getData ( ) )
                    -> setReplyTo ( $this -> container -> getParameter ( 'email_noreply' ) )
                    -> setcontenttype ( 'text/html' )
                    -> setBody (
                        $this -> renderView (
                            'remiiiMapBundle:Default:emailSpotProposalToSender.html.twig',
                            array (
                                'email' => $form -> get ( 'email' ) -> getdata ( )
                            )
                        )
                    ) ;
                $this -> get ( 'mailer' ) -> send ( $message ) ;

                // Email to Admin
                $message = \Swift_Message::newInstance ( )
                    -> setSubject ( '[AddSpot] ' . $form -> get ( 'name' ) -> getData ( ) )
                    -> setFrom ( $form -> get ( 'email' ) -> getData ( ) )
                    -> setTo ( $this -> container -> getParameter ( 'email_admin' ) )
                    -> setReplyTo ( $this -> container -> getParameter ( 'email_noreply' ) )
                    -> setcontenttype ( 'text/html' )
                    -> setBody (
                        $this -> renderView (
                            'remiiiMapBundle:Default:emailSpotProposalToAdmin.html.twig' ,
                            array (
                                'email' => $form -> get ( 'email' ) -> getdata ( )
                            )
                        )
                    ) ;
                $this -> get ( 'mailer' ) -> send ( $message ) ;

                $em = $this -> getDoctrine ( ) -> getManager ( ) ;

                $em -> persist ( $spotProposal ) ;
                $em -> flush ( ) ;

                $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Roger that dude!' ) ;

                return $this -> redirect ( $this -> get ( 'router' ) -> generate ( 'remiii_map_spotProposalAdd' ) ) ;

            }
            else
            {
                $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Something was wrong! :-(' ) ;
            }

        }

        return array ( 'form' => $form -> createview ( ) ) ;

    }

    /**
     *@Template
     */
    public function spotProposalUpdateAction ( Request $request , $x , $y , $name )
    {

        $em = $this -> getDoctrine ( ) -> getManager ( ) ;
        $spot = $em ->getRepository('remiiiGlobalBundle:Spot') -> findOneByUrl ( $x . '/' . $y . '/' . $name ) ;

        if ( $spot )
        {

            $spotProposal = new SpotProposal ( ) ;
            $spotProposal -> setIp ( $request -> getClientIp ( ) ) ;

            $spotProposal -> setX ( $spot -> getX ( ) ) ;
            $spotProposal -> setY ( $spot -> getY ( ) ) ;
            $spotProposal -> setName ( $spot -> getName ( ) ) ;

            $form = $this->createForm(new SpotProposalType(), $spotProposal );

            if ($request->isMethod('POST'))
            {

                $form -> handleRequest ( $request ) ;

                if ( $form -> isValid ( ) )
                {

                    // Email to sender
                    $message = \Swift_Message::newInstance ( )
                        -> setSubject ( 'Add spot: ' . $form -> get ( 'name' ) -> getData ( ) )
                        -> setFrom ( $this -> container -> getParameter ( 'email_noreply' ) )
                        -> setTo ( $form -> get ( 'email' ) -> getData ( ) )
                        -> setReplyTo ( $this -> container -> getParameter ( 'email_noreply' ) )
                        -> setcontenttype ( 'text/html' )
                        -> setBody (
                            $this -> renderView (
                                'remiiiMapBundle:Default:emailSpotProposalToSender.html.twig',
                                array (
                                    'email' => $form -> get ( 'email' ) -> getdata ( )
                                )
                            )
                        ) ;
                    $this -> get ( 'mailer' ) -> send ( $message ) ;

                    // Email to Admin
                    $message = \Swift_Message::newInstance ( )
                        -> setSubject ( '[AddSpot] ' . $form -> get ( 'name' ) -> getData ( ) )
                        -> setFrom ( $form -> get ( 'email' ) -> getData ( ) )
                        -> setTo ( $this -> container -> getParameter ( 'email_admin' ) )
                        -> setReplyTo ( $this -> container -> getParameter ( 'email_noreply' ) )
                        -> setcontenttype ( 'text/html' )
                        -> setBody (
                            $this -> renderView (
                                'remiiiMapBundle:Default:emailSpotProposalToAdmin.html.twig' ,
                                array (
                                    'email' => $form -> get ( 'email' ) -> getdata ( )
                                )
                            )
                        ) ;
                    $this -> get ( 'mailer' ) -> send ( $message ) ;

                    $em -> persist ( $spotProposal ) ;
                    $em -> flush ( ) ;

                    $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Roger that dude!' ) ;

                    return $this -> redirect ( $this -> get ( 'router' ) -> generate ( 'remiii_map_spotProposalAdd' ) ) ;

                }
                else
                {
                    $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Something was wrong! :-(' ) ;
                }

            }

            return array (
                'form' => $form -> createview ( ),
                'spotName' => $spot -> getName ( )
            ) ;

        }
        else
        {
            throw $this -> createNotFoundException ( 'Page introuvable' ) ;
        }

    }

    /**
     *@Template
     */
    public function spotAddAction ( Request $request )
    {

        $spot = new Spot ( ) ;
        $spotWebcam = new SpotWebcam ( ) ;
        $spot -> addSpotWebcam ( $spotWebcam ) ;
        $spotWebcam -> setSpot ( $spot ) ;

        $form = $this -> createForm ( new SpotType ( ) , $spot ) ;

        $form -> handleRequest ( $request ) ;

        if ( $form -> isValid ( ) )
        {

            // TODO
            $em = $this -> getDoctrine ( ) -> getManager ( ) ;
            /*foreach ($spot->getSpotPhotos() as $spotPhoto)
            {
                $spotPhoto->setSpot($spot) ;
            }*/
            //$em=$this->getDoctrine()->getManager() ;
            $em -> persist ( $spot ) ;
            $em -> flush ( ) ;

            $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Roger that dude! Spot added...' ) ;

            return $this -> redirect ( $this -> get ( 'router' ) -> generate ( 'remiii_map_spotAdd' ) ) ;

        }

        return array ( 'form' => $form -> createview ( ) ) ;


    }

    /**
     *@Template
     */
    public function spotUpdateAction ( Request $request, $x, $y, $name )
    {

        $em = $this -> getDoctrine ( ) -> getManager ( ) ;
        $spot = $em -> getRepository ( 'remiiiGlobalBundle:Spot') -> findOneByUrl ( $x . '/' . $y . '/' . $name ) ;

        if ( $spot )
        {

            $form = $this -> createForm ( new SpotType ( ) , $spot ) ;

            $form -> handleRequest ( $request ) ;

            if ( $form -> isValid ( ) )
            {

                $spot -> setLastModified ( new \DateTime ( ) ) ;

                /*foreach ( $spot -> getSpotPhotos ( ) as $spotPhoto )
                {
                    $spotPhoto -> setSpot ( $spot ) ;
                }*/
                $em -> persist ( $spot ) ;
                $em -> flush ( ) ;

                $request -> getSession ( ) -> getFlashBag ( ) -> add ( 'messages' , 'Roger that dude!' ) ;

                return $this -> redirect ( $this -> get ( 'router' ) -> generate ( 'remiii_map_spotUpdate' , array ( 'x' => $x , 'y' => $y , 'name' => $name ) ) ) ;

            }

            return array ( 'form' => $form -> createview ( ) ) ;

        }
        else
        {
            throw $this -> createNotFoundException ( 'Page introuvable' ) ;
        }

    }

}

