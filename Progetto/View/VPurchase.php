<?php

class VPurchase{
    
    public static function startPurchase(bool $isLogged = false, int $plotPoints = 0, $proPic = null, bool $isAbbonato = false): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> pagamento.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('pagamento.tpl');
    }

    public static function buy(bool $isLogged = false, int $plotPoints = 0 , $proPic = null , bool $isAbbonato = false, float $points, ESubscription $subscription, ECreditCard $card): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> pagamento.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('subscription', $subscription);
        $smarty->assign('card', $card);
        $smarty->assign('points', $points);
        $smarty->display('pagamento.tpl');
    }
}