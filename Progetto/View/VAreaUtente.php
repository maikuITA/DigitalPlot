<?php

namespace View;

use Start\StartSmarty;
use Smarty\Exception;
use Utility\LogSys;

class VAreaUtente {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function display() {
        $smarty = StartSmarty::configuration();

        //$smarty->assign('saluto', 'SI CAZZO FUNZIONA! Lino gay');
        //$smarty->assign('giorno', date('l'));
        LogSys::toLog("Display -> area_utente.tpl");
        $smarty->display('area_utente.tpl');
    }
}
