<?

class VHome {

    /**
     * Mostra la homepage con i dati ricevuti dal controller.
     * @throws Exception
     */
    public static function display() {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> home.tpl");
        $smarty->display('home.tpl');
    }
}