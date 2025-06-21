<?php

class VPurchase{
    
    public static function showPaymentsView(bool $isLogged = false, int $plotPoints = 0 , $proPic = null , bool $isAbbonato = false, ESubscription $subscription, ECreditCard $card): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> pagamento.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('subscription', $subscription);
        $smarty->assign('card', $card);
        $smarty->display('pagamento.tpl');
    }
}