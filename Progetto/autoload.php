<?php

function my_autoloader($className) {

    //if ($className == 'CGestioneMobile') include_once( 'Controller/'. $className . '.php' );
    //elseif ($className == 'VGestioneMobile') include_once( 'View/'. $className . '.php' );
    //else {
    
    //echo "className: " . $className;
    $arr = explode("\\", $className);
    //print_r($arr);
    
    $firstLetter = $className[0];
    switch ($firstLetter) {
        case 'C':
            include_once( 'Controller/'. $arr[1] . '.php' );
            break;

        case 'E':
            include_once( 'Entity/'. $arr[1] . '.php' );
            break;

        case 'F':
            include_once( 'Foundation/'. $arr[1] . '.php' );
            break;

        case 'V':
            include_once( 'View/'. $arr[1] . '.php' );
            break;

        case 'U':
            include_once( 'Utility/'. $arr[1] . '.php' );
            break;    
  }
}

spl_autoload_register('my_autoloader');

?>