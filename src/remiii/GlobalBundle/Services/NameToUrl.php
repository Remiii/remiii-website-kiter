<?php

namespace remiii\GlobalBundle\Services ;

class NameToUrl
{

    public function __construct ( ) { }

    public function getUrl ( $name )
    {
        return preg_replace ( '/[^a-zA-Z0-9]+/' , '-' ,
            substr ( str_replace ( ' ' , '-' ,  iconv ( 'utf8', 'ascii//TRANSLIT', strtolower ( $name ) ) ) , 0 , 50 )
        ) ;
    }

}

