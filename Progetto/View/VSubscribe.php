<?php

class VSubscribe {

    /**
     * Method to render the subscription view
     * This method uses Smarty to render the 'abbonati.tpl' template.
     * It assigns the 'isLogged' variable to the template and displays it.
     * @param bool $isLogged Indicates if the user is logged in
     * @return void
     */
    public static function render(bool $isLogged = false, $plotPoints = 0 , $proPic = null, bool $isAbbonato = false): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> abbonati.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('abbonati.tpl');
    }
}