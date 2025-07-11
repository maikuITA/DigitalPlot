<?php

class VSubscribe
{

    /**
     * Method to render the subscription view
     * @param bool $isLogged Indicates if the user is logged in
     * @param int $plotPoints The number of plot points the user has
     * @param mixed $proPic The user's profile picture data
     * @param int $privilege  Indicates if the user is a subscriber
     * @param array|null $subs An array of subscriptions, if available
     * @return void
     */
    public static function render(bool $isLogged = false, int $plotPoints = 0, mixed $proPic = null, int $privilege = BASIC, $subs = null): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> abbonati.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('subscriptions', $subs);
        $smarty->display('abbonati.tpl');
    }
}
