<?php

namespace remiii\GlobalBundle\DataFixtures\ORM ;

use Doctrine\Common\DataFixtures\FixtureInterface ;
use Doctrine\Common\Persistence\ObjectManager ;
use Symfony\Component\DependencyInjection\ContainerAwareInterface ;
use Symfony\Component\DependencyInjection\ContainerInterface;
use remiii\GlobalBundle\Services\FixtureLoader ;

use remiii\GlobalBundle\Entity\Spot ;

class LoadSpotData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container ;

    /**
     * {@inheritDoc}
     */
    public function setContainer ( ContainerInterface $container = null )
    {
        $this -> container = $container ;
    }

    /**
     *
     */
    public function load ( ObjectManager $manager )
    {
        $fixtureLoader = $this -> container -> get ( 'remiii_global.fixtureLoader' ) ;
        $data = $fixtureLoader -> getData ( __DIR__ . '/fixtures/' . 'spot.tsv' ) ;

        foreach ( $data as $key => $row )
        {
            $spot = new Spot ( ) ;
            if ( $row [ 'input' ] != null ) $spot -> setInput ( $row [ 'input' ] ) ;
            if ( $row [ 'lastModifiedInput' ] != null ) $spot -> setLastModifiedInput ( new \DateTime ( ) ) ;
            if ( $row [ 'sportInput' ] != null ) $spot -> setSportInput ( $row [ 'sportInput' ] ) ;
            if ( $row [ 'x' ] != null ) $spot -> setX ( $row [ 'x' ] ) ;
            if ( $row [ 'y' ] != null ) $spot -> setY ( $row [ 'y' ] ) ;
            if ( $row [ 'name' ] != null ) $spot -> setName ( $row [ 'name' ] ) ;
            if ( $row [ 'description' ] != null ) $spot -> setDescription ( $row [ 'description' ] ) ;
            if ( $row [ 'url' ] != null ) $spot -> setUrl ( $row [ 'url' ] ) ;
            if ( $row [ 'sport' ] != null ) $spot -> setSport ( $row [ 'sport' ] ) ;
            if ( $row [ 'sportExtra' ] != null ) $spot -> setSportExtra ( $row [ 'sportExtra' ] ) ;
            if ( $row [ 'wind' ] != null ) $spot -> setWind ( $row [ 'wind' ] ) ;
            if ( $row [ 'windExtra' ] != null ) $spot -> setWindExtra ( $row [ 'windExtra' ] ) ;
            if ( $row [ 'tide' ] != null ) $spot -> setTide ( $row [ 'tide' ] ) ;
            if ( $row [ 'tideExtra' ] != null ) $spot -> setTideExtra ( $row [ 'tideExtra' ] ) ;
            if ( $row [ 'condition' ] != null ) $spot -> setCondition ( $row [ 'condition' ] ) ;
            if ( $row [ 'conditionExtra' ] != null ) $spot -> setConditionExtra ( $row [ 'conditionExtra' ] ) ;
            if ( $row [ 'hazard' ] != null ) $spot -> setHazard ( $row [ 'hazard' ] ) ;
            if ( $row [ 'hazardExtra' ] != null ) $spot -> setHazardExtra ( $row [ 'hazardExtra' ] ) ;
            if ( $row [ 'rule' ] != null ) $spot -> setRule ( $row [ 'rule' ] ) ;
            if ( $row [ 'ruleExtra' ] != null ) $spot -> setRuleExtra ( $row [ 'ruleExtra' ] ) ;
            if ( $row [ 'surface' ] != null ) $spot -> setSurface ( $row [ 'surface' ] ) ;
            if ( $row [ 'surfaceExtra' ] != null ) $spot -> setSurfaceExtra ( $row [ 'surfaceExtra' ] ) ;
            $manager -> persist ( $spot ) ;
        }
        $manager -> flush ( ) ;
    }

}

