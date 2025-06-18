<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor'. DIRECTORY_SEPARATOR . 'autoload.php');
use Smarty\Smarty;

class StartSmarty{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->setTemplateDir('./Progetto/Smarty/templates/');
        $smarty->setCompileDir('./Progetto/Smarty/templates_c/');
        return $smarty;
    }
}