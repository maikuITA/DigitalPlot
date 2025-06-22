<?php

class VDashboard{

    /**
     * Render the dashboard view.
     * This function sets up the Smarty template engine and assigns variables to it.
     * It then displays the 'dashboard.tpl' template.
     *
     * @param bool $privilege  Indicates if the user is a subscriber.
     * @param int $plotPoints The number of plot points the user has.
     * @param ?string $proPic The user's profile picture, if available.
     * @param bool $isLogged Indicates if the user is logged in.
     */
    public static function render( bool $privilege = ADMIN, int $plotPoints = 0, ?string $proPic = null, bool $isLogged = true): void {
        $smarty = StartSmarty::configuration();
        //$smarty->clearCache('home.tpl');
        ULogSys::toLog("Display -> dashboard.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('dashboard.tpl');
    }
}