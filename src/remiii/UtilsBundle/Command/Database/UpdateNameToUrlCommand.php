<?php

namespace remiii\UtilsBundle\Command\Database ;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand ;
use Symfony\Component\Console\Input\InputArgument ;
use Symfony\Component\Console\Input\InputInterface ;
use Symfony\Component\Console\Input\InputOption ;
use Symfony\Component\Console\Output\OutputInterface ;

use Symfony\Component\Console\Helper\DialogHelper ;
use Symfony\Component\Console\Helper\HelperSet ;

class UpdateNameToUrlCommand extends ContainerAwareCommand
{

    protected $em ;
    protected $nameToUrlService ;

    protected function configure ( )
    {
        $this
            -> setname ( 'remiii:utils:database:update-name-to-url' )
            -> setDescription ( 'Utils: Create/Update name to url in DB' ) ;
    }

    /**
     * @see Command
     */
    protected function execute ( InputInterface $input , OutputInterface $output )
    {

        $em = $this -> getContainer ( ) -> get ( 'doctrine.orm.entity_manager' ) ;
        $this -> nameToUrlService = $this -> getContainer ( ) -> get ( 'remiii_global.nameToUrl' ) ;

        $output -> writeln ( '<info>Create/Update from name to url entries in DB</info>' ) ;

        $spots = $em -> getRepository ( 'remiiiGlobalBundle:Spot' ) -> findAll ( ) ;

        foreach ( $spots as $spot )
        {
            if ( $spot -> getCountry ( ) != null && $spot -> getCountryUrl ( ) == null ) $spot -> setCountryUrl ( $this -> nameToUrlService -> getUrl ( $spot -> getCountry ( ) ) ) ;
            if ( $spot -> getState ( ) != null && $spot -> getStateUrl ( ) == null ) $spot -> setStateUrl ( $this -> nameToUrlService -> getUrl ( $spot -> getState ( ) ) ) ;
            if ( $spot -> getCounty ( ) != null && $spot -> getCountyUrl ( ) == null ) $spot -> setCountyUrl ( $this -> nameToUrlService -> getUrl ( $spot -> getCounty ( ) ) ) ;
            if ( $spot -> getCity ( ) != null && $spot -> getCityUrl ( ) == null ) $spot -> setCityUrl ( $this -> nameToUrlService -> getUrl ( $spot -> getCity ( ) ) ) ;
            $em -> persist ( $spot ) ;
            $em -> flush ( ) ;
        }

    }

}

