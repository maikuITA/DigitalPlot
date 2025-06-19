<?php

class VUser{

    public static function home(?string $username = null, ?int $plotPoints = null, $proPic = null, ?array $articles = null, bool $logged = false){
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> home.tpl");
        $smarty->assign('isLogged', $logged);
        $smarty->assign('username', $username);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('articles', $articles);
        $smarty->display('home.tpl');
    }
}