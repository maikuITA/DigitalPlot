<?php

class VAbbonati {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render() {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> abbonati.tpl");
        $smarty->display('abbonati.tpl');
    }
}