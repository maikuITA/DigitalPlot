<?php

class CPurchase{

    public static function makePurchase(int $subscriptionCod): void {
        if($subscriptionCod === null || $subscriptionCod <= 0){
            header('Location: https://digitalplot.altervista.org/error');
            exit();
        }
        if(CUser::isLogged()){
            $subscription = FPersistentManager::getInstance()->retrieveObjById(ESubscription::class, $subscriptionCod);
            if(!isset($subscription)){
                header('Location: https://digitalplot.altervista.org/error');
                exit();
            }
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('userId'));
            $card = self::getCreditCard();
            VPurchase::showPaymentsView(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), true, $subscription, $card);
        } else{
            header('Location: https://digitalplot.altervista.org/login');
            exit();
        } 
    }

    public static function getCreditCard(): ECreditCard {
        $cardNumber = UHTTPMethods::post('cardNumber');
        $name = UHTTPMethods::post('name');
        $surname = UHTTPMethods::post('surname');
        $expiration = UHTTPMethods::post('expirationDate');
        $cvv = UHTTPMethods::post('cvv');
        $card = new ECreditCard($cardNumber, $name, $surname, $expiration, $cvv);
        return $card;
    }
}