<?php

namespace remiii\GlobalBundle\Services ;

class FixtureLoader
{

    public function getData ( $fixtures )
    {
        $handle = file ( $fixtures ) ;
        $headers = array ( ) ;
        $data = array ( ) ;
        foreach ( $handle as $index => $line )
        {
            $cells = str_getcsv ( $line , "\t" , '"' , "\\" ) ;
            if ( $index == 0 )
            {
                foreach ( $cells as $cell )
                {
                    $headers [ ] = trim ( $cell ) ;
                }
            }
            else
            {
                $line = array ( ) ;
                foreach ( $cells as $edx => $cell )
                {
                    if ( $cell == 'NULL' )
                    {
                        $line [ $headers [ $edx ] ] = null ;
                    }
                    else
                    {
                        $line [ $headers [ $edx ] ] = $cell ;
                    }
                }
                $data [ ] = $line ;
            }
        }
        var_dump ( $data ) ;
        return $data ;
    }

}
