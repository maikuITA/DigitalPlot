<?php

class VLogs
{

    /**
     * Method to render the log view.
     * This method uses Smarty to render the 'log.tpl' template with the provided user information.
     * @param int $privilege The user's privilege level (default is BASIC).
     * @param int $plotPoints The number of plot points the user has (default is 0).
     * @param mixed $proPic The user's profile picture data (default is null).
     * @param bool $isLogged Indicates if the user is logged in (default is false).
     * @return void
     */
    public static function render(int $privilege = ADMIN, int  $plotPoints = 0, mixed $proPic = null, bool $isLogged = false): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> log.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('log.tpl');
    }
}
