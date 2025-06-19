<?php

class VAccess{

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render() {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> accesso.tpl");
        $smarty->display('accesso.tpl');
    }
}