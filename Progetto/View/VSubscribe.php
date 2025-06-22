<?php

class VSubscribe {

    /**
     * Method to render the subscription view
     * This method uses Smarty to render the 'abbonati.tpl' template.
     * It assigns the 'isLogged' variable to the template and displays it.
     * @param bool $isLogged Indicates if the user is logged in
     * @param int $plotPoints The number of plot points the user has
     * @param mixed $proPic The user's profile picture data
     * @param bool $isAbbonato Indicates if the user is a subscriber
     * @param array|null $subs An array of subscriptions, if available
     * @return void
     */
    public static function render(bool $isLogged = false, $plotPoints = 0 , $proPic = null, int $isAbbonato = BASIC, ?array $subs = null ): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> abbonati.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('subscriptions', $subs);
        $smarty->display('abbonati.tpl');
    }
}