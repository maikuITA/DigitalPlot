<?php

class CPurchase{


    public static function startPurchase(int $subscriptionCod): void {
        if($subscriptionCod === null || $subscriptionCod <= 0){
            header('Location: https://digitalplot.altervista.org/error');
            exit();
        }
        $subscription = FPersistentManager::getInstance()->retrieveObjById(ESubscription::class, $subscriptionCod);
         if(!isset($subscription)){
                header('Location: https://digitalplot.altervista.org/error');
                exit();
        }
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('userId'));
            $points = self::verifyPoints($user->getPlotCard()->getPoints(), $subscription->getPrice());
            VPurchase::startPurchase(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), false, $subscription, $points);
        } else{
            header('Location: https://digitalplot.altervista.org/login');
            exit();
        } 
    }

   
    public static function purchase(int $subscriptionCod): void {
        if(!CUser::isLogged()){
            header('Location: https://digitalplot.altervista.org/login');
            exit();
        }
        $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('userId'));
        $subscription = FPersistentManager::getInstance()->retrieveObjById(ESubscription::class, $subscriptionCod);
        $card = self::getCreditCard();
        $points = self::verifyPoints($user->getPlotCard()->getPoints(), $subscription->getPrice());
        VPurchase::buy(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), true, $points, $subscription, $card);
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

    public static function verifyPoints(int $points, float $price): float {
        $difference = $price - ($points * 0.01);
        if ($difference > 0) {
            return $points * 0.01; 
        } else {
            return 0;
        }

    }
}