<?php

namespace remiii\UtilsBundle\Command\Database ;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand ;
use Symfony\Component\Console\Input\InputArgument ;
use Symfony\Component\Console\Input\InputInterface ;
use Symfony\Component\Console\Input\InputOption ;
use Symfony\Component\Console\Output\OutputInterface ;

use Symfony\Component\Console\Helper\DialogHelper ;
use Symfony\Component\Console\Helper\HelperSet ;

use Guzzle\Http\Client ;

class UpdateGeoInfoCommand extends ContainerAwareCommand
{

    protected function configure ( )
    {
        $this
            -> setname ( 'remiii:utils:database:update-geo-info' )
            -> setDescription ( 'Utils: Create/Update geo informations entries in DB' ) ;
    }

    /**
     * @see Command
     */
    protected function execute ( InputInterface $input , OutputInterface $output )
    {

        $em = $this -> getContainer ( ) -> get ( 'doctrine.orm.entity_manager' ) ;

        $output -> writeln ( '<info>Create/Update geo informations entries in DB</info>' ) ;

        $spots = $em -> getRepository ( 'remiiiGlobalBundle:Spot' ) -> getSpotsWithEmptyCountryAndStateAndCountyAndCity ( ) ;

        foreach ( $spots as $spot )
        {
            $geoInfo = $this -> getGeoInfo (
                $spot -> getX ( ) ,
                $spot -> getY ( ) ,
                $spot -> getLocale ( )
            ) ;
            $spot -> setCountry ( $geoInfo [ 'country' ] ) ;
            $spot -> setState ( $geoInfo [ 'state' ] ) ;
            $spot -> setCounty ( $geoInfo [ 'county' ] ) ;
            $spot -> setCity ( $geoInfo [ 'city' ] ) ;
            $em -> persist ( $spot ) ;
            $em -> flush ( ) ;
            sleep ( 1 ) ;
        }

    }

    protected function getGeoInfo ( $geoCodeX , $geoCodeY , $locale = null )
    {
        if ( $locale == null ) $locale = 'en' ;
        $coords = array ( ) ;
        $baseUrl = 'http://maps.googleapis.com' ;
        $uri = '/maps/api/geocode/xml?latlng=' . urlencode ( $geoCodeY ) . ',' . urlencode ( $geoCodeX ) . '&sensor=false&language=' . $locale ;
        $client = new Client( $baseUrl ) ;
        $request = $client -> get ( $uri ) ;
        $response = $request -> send ( ) ;
        $xml = simplexml_load_string ( $response -> getBody ( ) ) ;
        $geoInfo [ 'status' ] = $xml -> status ;
        $geoInfo [ 'country' ] = null ;
        $geoInfo [ 'state' ] = null ;
        $geoInfo [ 'county' ] = null ;
        $geoInfo [ 'city' ] = null ;
        if ( $geoInfo [ 'status' ] == 'OK' )
        {
            echo '.' ;
            foreach ( $xml -> result [ 0 ] -> address_component as $item )
            {
                switch ( $item -> type )
                {
                    case 'country' :
                        $geoInfo [ 'country' ] = $item -> long_name ;
                        break ;
                    case 'administrative_area_level_1' :
                        $geoInfo [ 'state' ] = $item -> long_name ;
                        break ;
                    case 'administrative_area_level_2' :
                        $geoInfo [ 'county' ] = $item -> long_name ;
                        break ;
                    case 'locality' :
                        $geoInfo [ 'city' ] = $item -> long_name ;
                        break ;
                }
            }
            return array (
                'country' => $geoInfo [ 'country' ] ,
                'state' => $geoInfo [ 'state' ] ,
                'county' => $geoInfo [ 'county' ] ,
                'city' => $geoInfo [ 'city' ]
            ) ;
        }
        else
        {
            echo 'x' ;
            return null ;
        }
    }
}

