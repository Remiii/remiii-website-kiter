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
    public function map3rdPartyAction ( $vendor = null )
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
     * @Template
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
                    -> setFrom ( array ( $this -> container -> getParameter ( 'email_noreply' ) => 'kiter.io' ) )
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
                    -> setFrom ( array ( $form -> get ( 'email' ) -> getData ( ) => 'kiter.io' ) )
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
     * @Template
     */
    public function spotProposalUpdateAction ( Request $request , $x , $y , $name )
    {

        $em = $this -> getDoctrine ( ) -> getManager ( ) ;
        $spot = $em -> getRepository ( 'remiiiGlobalBundle:Spot' ) -> findOneByUrl ( $x . '/' . $y . '/' . $name ) ;

        if ( $spot )
        {

            $spotProposal = new SpotProposal ( ) ;
            $spotProposal -> setIp ( $request -> getClientIp ( ) ) ;

            $spotProposal -> setX ( $spot -> getX ( ) ) ;
            $spotProposal -> setY ( $spot -> getY ( ) ) ;
            $spotProposal -> setName ( $spot -> getName ( ) ) ;
            $spotProposal -> setDescription ( $spot -> getDescription ( ) ) ;
            $spotProposal -> setSport ( $spot -> getSport ( ) ) ;
            $spotProposal -> setSportExtra ( $spot -> getSportExtra ( ) ) ;
            $spotProposal -> setWind ( $spot -> getWind ( ) ) ;
            $spotProposal -> setWindExtra ( $spot -> getWindExtra ( ) ) ;
            $spotProposal -> setTide ( $spot -> getTide ( ) ) ;
            $spotProposal -> setTideExtra ( $spot -> getTideExtra ( ) ) ;
            $spotProposal -> setCondition ( $spot -> getCondition ( ) ) ;
            $spotProposal -> setConditionExtra ( $spot -> getConditionExtra ( ) ) ;
            $spotProposal -> setHazard ( $spot -> getHazard ( ) ) ;
            $spotProposal -> setHazardExtra ( $spot -> getHazardExtra ( ) ) ;
            $spotProposal -> setRule ( $spot -> getRule ( ) ) ;
            $spotProposal -> setRuleExtra ( $spot -> getRuleExtra ( ) ) ;
            $spotProposal -> setSurface ( $spot -> getSurface ( ) ) ;
            $spotProposal -> setSurfaceExtra ( $spot -> getSurfaceExtra ( ) ) ;

            $form = $this->createForm(new SpotProposalType(), $spotProposal );

            if ($request->isMethod('POST'))
            {

                $form -> handleRequest ( $request ) ;

                if ( $form -> isValid ( ) )
                {

                    // Email to sender
                    $message = \Swift_Message::newInstance ( )
                        -> setSubject ( 'Add spot: ' . $form -> get ( 'name' ) -> getData ( ) )
                        -> setFrom ( array ( $this -> container -> getParameter ( 'email_noreply' ) => 'kiter.io' ) )
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
                        -> setFrom ( array ( $form -> get ( 'email' ) -> getData ( ) => 'kiter.io' ) )
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
     * @Template
     */
    public function spotProposalListAction ( Request $request )
    {

        $em = $this -> getDoctrine ( ) -> getManager ( ) ;
        $spotsProposal = $em -> getRepository ( 'remiiiGlobalBundle:SpotProposal' ) -> findAll ( ) ;
        return array ( 'spotsProposal' => $spotsProposal ) ;

    }

    /**
     * @Template
     */
    public function spotAddAction ( Request $request )
    {

        $spot = new Spot ( ) ;
        //$spotWebcam = new SpotWebcam ( ) ;
        //$spot -> addSpotWebcam ( $spotWebcam ) ;
        //$spotWebcam -> setSpot ( $spot ) ;

        $form = $this -> createForm ( new SpotType ( ) , $spot ) ;

        $form -> handleRequest ( $request ) ;

        if ( $form -> isValid ( ) )
        {

            // TODO
            $em = $this -> getDoctrine ( ) -> getManager ( ) ;
            $url = number_format ( round ( $spot -> getX ( ) , 3 ) , 3 , '.' , '' ) . '/' . number_format ( round ( $spot -> getY ( ) , 3 ) , 3 , '.' , '' ) . '/' .
                preg_replace ( '/[^a-zA-Z0-9]+/' , '-' ,
                substr ( str_replace ( ' ' , '-' ,  iconv('utf8', 'ascii//TRANSLIT', strtolower ( $spot -> getName ( ) ) ) ) , 0 , 40 ) ) ;
            $spot -> setUrl ( $url ) ;
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
     * @Template
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

