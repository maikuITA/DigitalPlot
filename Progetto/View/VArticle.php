<?php

class VArticle{

    public static function showArticle(bool $isLogged = false, int $plotPoints = 0 , $proPic = null , bool $isAbbonato = false ): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> lettura.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('lettura.tpl');
    }
}