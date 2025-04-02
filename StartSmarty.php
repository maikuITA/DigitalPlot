<?php

namespace Start;

require_once __DIR__ . '/vendor/autoload.php';
use Smarty\Smarty;

class StartSmarty{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->setTemplateDir('./Progetto/Smarty/templates/');
        $smarty->setCompileDir('./Progetto/Smarty/templates_c/');
        return $smarty;
    }
}