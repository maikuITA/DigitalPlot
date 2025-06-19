<?php

class VHome {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render() {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> home.tpl");
        $smarty->assign('isLogged', 'true');
        $smarty->display('home.tpl');
    }
}