<?php

class VError {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render(string $errore, $poltPoints = 0 , $proPic = null , bool $isLogged = false): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> error404.tpl");
        $smarty->assign('errore', $errore);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('poltPoints', $poltPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('error404.tpl');
    }
}