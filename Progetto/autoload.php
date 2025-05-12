<?php
function myautoload($class_name){
    $class_name = str_replace("\\", DIRECTORY_SEPARATOR, $class_name); // Gestione namespace
    $class1 = __DIR__ . DIRECTORY_SEPARATOR . "Entity" . DIRECTORY_SEPARATOR . $class_name . ".php";
    $class2 = __DIR__ . DIRECTORY_SEPARATOR . "Foundation" . DIRECTORY_SEPARATOR . $class_name . ".php";
    $class3 = __DIR__ . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . $class_name . ".php";
    $class4 = __DIR__ . DIRECTORY_SEPARATOR . "View" . DIRECTORY_SEPARATOR . $class_name . ".php";
    $class5 = __DIR__ . DIRECTORY_SEPARATOR . "Utility" . DIRECTORY_SEPARATOR . $class_name . ".php";
    $class6 = __DIR__ . DIRECTORY_SEPARATOR . $class_name . ".php";

    if (file_exists($class1)) {
        include $class1;
    } elseif (file_exists($class2)) {
        include $class2;
    } elseif (file_exists($class3)) {
        include $class3;
    } elseif (file_exists($class4)) {
        include $class4;
    } elseif (file_exists($class5)) {
        include $class5;
    } elseif (file_exists($class6)) {
        include $class6;    
    } else {
        echo "error: file not found for class $class_name";
        return false;
    }

    return true;
}