<?php

class VDashboard
{

    /**
     * Render the dashboard view.
     * @param int $privilege  Indicates if the user is a subscriber.
     * @param int $plotPoints The number of plot points the user has.
     * @param string|null $proPic The user's profile picture, if available.
     * @param bool $isLogged Indicates if the user is logged in.
     * @param array|null $articoliDaRevisionare Articles to be reviewed, if any.
     * @param array|null $articoliPubblicati Articles that have been published, if any.
     * @param array|null $commenti Comments made by the user, if any
     * @return void 
     */
    public static function render(int $privilege = ADMIN, int $plotPoints = 0, ?string $proPic = null, bool $isLogged = true, ?array $articoliDaRevisionare, ?array $articoliPubblicati, ?array $commenti): void
    {
        $smarty = StartSmarty::configuration();
        //$smarty->clearCache('home.tpl');
        ULogSys::toLog("Display -> dashboard.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('articoliDaRevisionare', $articoliDaRevisionare);
        $smarty->assign('articoliPubblicati', $articoliPubblicati);
        $smarty->assign('commenti', $commenti);
        $smarty->display('dashboard.tpl');
    }
}
