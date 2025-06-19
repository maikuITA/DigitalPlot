<?php

class VHome {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function render() {
        $smarty = StartSmarty::configuration();
        //$smarty->clearCache('home.tpl');
        ULogSys::toLog("Display -> home.tpl");
        $smarty->assign('isLogged', true);
        $smarty->assign('username', 'Pippo');
        $smarty->assign('plotPoints', 100);
        $smarty->assign('proPic', null);
        $smarty->assign('articles', $articles ?? []);
        $smarty->display('home.tpl');
    }
}