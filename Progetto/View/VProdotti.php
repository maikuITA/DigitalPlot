<?php

namespace View;

use Start\StartSmarty;
use Smarty\Exception;
use Utility\LogSys;

class VProdotti {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function display() {
        $smarty = StartSmarty::configuration();

        //$smarty->assign('saluto', 'SI CAZZO FUNZIONA! Lino gay');
        //$smarty->assign('giorno', date('l'));
        LogSys::toLog("Display -> prodotti.tpl");
        $smarty->display('prodotti.tpl');
    }
}
