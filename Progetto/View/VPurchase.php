<?php

class VPurchase{
    
    /**
     * Method to start the purchase process.
     * This method uses Smarty to render the 'pagamento.tpl' template with the provided parameters.
     *
     * @param EUser $user The user who is making the purchase.
     * @param bool $isLogged Indicates if the user is logged in.
     * @param int $plotPoints The number of plot points the user has.
     * @param mixed $proPic The user's profile picture data.
     * @param int $privilege The user's privilege level (default is BASIC).
     * @param ESubscription $subscription The subscription details.
     * @param float $poits The amount of points for the purchase.
     */
    public static function startPurchase(EUser $user, bool $isLogged = false, int $plotPoints = 0, $proPic = null, int $privilege = BASIC, ESubscription $subscription, float $points): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> pagamento.tpl");
        $smarty->assign('user', $user);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic); 
        $smarty->assign('subscription', $subscription);
        $smarty->assign('points', $points);
        $smarty->display('pagamento.tpl');
    }

    /**
     * Method to display the payment page.
     * This method uses Smarty to render the 'pagamento.tpl' template with the provided parameters.
     *
     * @param bool $isLogged Indicates if the user is logged in.
     * @param int $plotPoints The number of plot points the user has.
     * @param mixed $proPic The user's profile picture data.
     * @param int $privilege The user's privilege level (default is BASIC).
     * @param float $points The amount of points for the purchase.
     * @param ESubscription $subscription The subscription details.
     * @param ECreditCard $card The credit card details.
     */
    public static function buy(bool $isLogged = false, int $plotPoints = 0 , $proPic = null , int $privilege = BASIC, float $points, ESubscription $subscription, ECreditCard $card): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> pagamento.tpl");
        ULogSys::toLog("");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('subscription', $subscription);
        $smarty->assign('card', $card);
        $smarty->assign('points', $points);
        $smarty->display('pagamento.tpl');
    }
}