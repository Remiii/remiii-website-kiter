<?php

$longopts  = array (
    "db::" ,            // Valeur optionnelle
    "path::" ,          // Valeur optionnelle
    "host::" ,          // valeur optionnelle
    "user::" ,          // Valeur optionnelle
    "password::" ,      // Valeur optionnelle
) ;

$shortopts = "" ;

$options = getopt($shortopts, $longopts) ;
$database = (in_array('db', array_keys($options))) ? $options['db'] : "remiii_website_kiter_dev1" ;
$path = (in_array('path', array_keys($options))) ? $options['path'] : "" ;
$host = (in_array('host', array_keys($options))) ? $options['host'] : "127.0.0.1" ;
$user = (in_array('user', array_keys($options))) ? $options['user'] : "root" ;
$password = (in_array('password', array_keys($options))) ? $options['password'] : "root" ;

$dsn = "mysql:host=$host;dbname=$database;charset=utf8" ;

$db = new PDO ( $dsn , $user , $password ) ;

$sql1 = 'SELECT * FROM spot WHERE url="" LIMIT 0,50000' ;

$stmt1 = $db -> query ( $sql1 ) ;

$results = $stmt1 -> fetchAll ( PDO::FETCH_ASSOC ) ;

foreach ( $results as $result )
{
    $tmp = number_format ( round ( $result [ 'x' ] , 3 ) , 3 , '.' , '' ) . '/' . number_format ( round ( $result [ 'y' ] , 3 ) , 3 , '.' , '' ) . '/' .
        preg_replace ( '/[^a-zA-Z0-9]+/' , '-' ,
        substr ( str_replace ( ' ' , '-' ,  iconv('utf8', 'ascii//TRANSLIT', strtolower ( $result [ 'name' ] ) ) ) , 0 , 40 ) ) ;
    echo ( $tmp . "\n" ) ;
    $sql2 = 'UPDATE spot SET url= "' . $tmp . '" WHERE id=' . $result [ 'id' ] ;
    $stmt2 = $db -> query ( $sql2 ) ;
}

