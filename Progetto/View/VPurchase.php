<?php

class VPurchase{
    
    public static function startPurchase(EUser $user, bool $isLogged = false, int $plotPoints = 0, $proPic = null, bool $isAbbonato = false, ESubscription $subscription, float $poits): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> pagamento.tpl");
        $smarty->assign('user', $user);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic); 
        $smarty->assign('subscription', $subscription);
        $smarty->assign('points', $poits);
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