<?php

class VLogs {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render(int $privilege = BASIC, $plotPoints = 0 , $proPic = null , bool $isLogged = false): void {
        $smarty = StartSmarty::configuration();
        //$smarty->clearCache('home.tpl');
        ULogSys::toLog("Display -> log.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('log.tpl');
    }
}