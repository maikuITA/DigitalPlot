<?php
// Autoloading delle classi

function myautoload($class_name){
    $class1 = __DIR__ . "\\" . "Entity\\" . $class_name . ".php";  // percorsi
    $class2 =  __DIR__ . "\\" . "Foundation\\" . $class_name . ".php";
    $class3 = __DIR__ . "\\" . "Controller\\" . $class_name . ".php";
    $class4 = __DIR__ . "\\" . "View\\" . $class_name . ".php";
    $class5 = __DIR__ . "\\" . "Utility\\" . $class_name . ".php";
    $class6 = __DIR__ . "\\" . $class_name . ".php";

    if ( file_exists( $class1 )){
        include $class1;
    } elseif ( file_exists( $class2 )){
        include $class2;
    } elseif ( file_exists( $class3 )){
        include $class3;
    } elseif ( file_exists( $class4 )){
        include $class4;
    } elseif ( file_exists( $class5 )){
        include $class5;
    } elseif ( file_exists( $class6 )){
        include $class6;    
    } else {
        echo "error";
        return false;
    }

    return true;
    
}
spl_autoload_register("myautoload");


?>