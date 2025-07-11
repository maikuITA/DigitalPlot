<?php

class VUser
{

    /**
     * This method is used to display the home page.
     * @param string|null $username The username of the logged-in user.
     * @param int|null $plotPoints The plot points of the user.
     * @param mixed $proPic The profile picture of the user.
     * @param mixed|null $articles The articles to be displayed on the home page.
     * @param bool $logged Indicates if the user is logged in.
     * @return void
     */
    public static function home(?string $username = null, ?int $plotPoints = null, $proPic = null, $articles = null, bool $isLogged = false, int $privilege = BASIC, int $remaningReadings = 0): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> home.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('username', $username);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('articles', $articles);
        $smarty->assign('remaningReadings', $remaningReadings);
        $smarty->display('home.tpl');
    }

    /**
     * This method is used to display the access page.
     * @param bool $isLogged Indicates if the user is logged in.
     * @param int $privilege The privilege level of the user (default is BASIC).
     * @return void
     */
    public static function auth(bool $isLogged = false, int $privilege = BASIC): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> accesso.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->display('accesso.tpl');
    }
}
