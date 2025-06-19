<?php

class VUser{

    public static function home( string $username, int $plotPoints, $proPic){
        $smarty = StartSmarty::configuration();
        // $smarty->clearCache('home.tpl');
        ULogSys::toLog("Display -> home.tpl");
        $smarty->assign('isLogged', true);
        $smarty->assign('username', $username);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('home.tpl');
    }
}