<?php

namespace remiii\CorporateBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template ;

class DefaultController extends Controller
{

    /**
     * @Template
     */
    public function homeAction ( )
    {
        return array ( ) ;
    }

    /**
     * @Template
     */
    public function legalAction ( )
    {
        return array ( ) ;
    }

    /**
     * @Template
     */
    public function faqAction ( )
    {
        return array ( ) ;
    }

    /**
     * @Template
     */
    public function aboutAction ( )
    {
        return array ( ) ;
    }

    /**
     * @Template
     */
    public function creditAction ( )
    {
        return array ( ) ;
    }

}

