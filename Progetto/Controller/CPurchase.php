<?php

class CPurchase{

    public static function makePurchase(int $subscriptionCod): array {
        if($subscriptionCod === null || $subscriptionCod <= 0){
            header('Location: https://digitalplot.altervista.org/error');
            exit();
        }
        if(CUser::isLogged()){
            $subscription = FPersistentManager::getInstance()->retriveObjById(ESubscription::class, $subscriptionCod);
            if(!isset($subscription)){
                header('Location: https://digitalplot.altervista.org/error');
                exit();
            }
            $user = FPersistentManager::getInstance()->retriveObjById(EUser::class, USession::getSessionElement('user'));
            $card = FPersistentManager::getInstance()->retriveObjById(ECreditCard::class, USession::getSessionElement('creditCard'));
            if(!isset($card)){
                    FPersistentManager::getInstance()->
                exit();
            }
            VPurchase::showPaymentsView(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), true, $subscription, $->getWriter());
        } else{
            header('Location: https://digitalplot.altervista.org/login');
            exit();
        } 
    }
}