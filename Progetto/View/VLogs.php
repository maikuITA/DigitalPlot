<?php

class VLogs {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render() {
        $smarty = StartSmarty::configuration();
        //$smarty->clearCache('home.tpl');
        ULogSys::toLog("Display -> log.tpl");
        $smarty->display('log.tpl');
    }
}