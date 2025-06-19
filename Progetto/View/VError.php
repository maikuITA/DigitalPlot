<?php

class VError {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render(string $errore) {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> error404.tpl");
        $smarty->assign('errore', $errore);
        $smarty->display('error404.tpl');
    }
}