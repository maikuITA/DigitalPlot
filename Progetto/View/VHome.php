<?php


use Start\StartSmarty;
use Smarty\Exception;
use Utility\LogSys;

class VHome {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function display() {
        $smarty = StartSmarty::configuration();
        LogSys::toLog("Display -> home.tpl");
        $smarty->display('home.tpl');
    }
}
