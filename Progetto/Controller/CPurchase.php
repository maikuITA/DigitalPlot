<?php

class CPurchase{

    /**
     * This class launch the purchase form
     * @param int $subscriptionCod The code of the subscription to purchase
     * @return void
    */
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
            if (!CUser::isSubbed()){
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                $points = EPurchase::calculateSubTotal($subscription->getPrice(), $user->getPlotCard()->getPoints());
                VPurchase::startPurchase($user,true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), $subscription, $points);
            } else {
                header('Location: https://digitalplot.altervista.org/home');
                exit();
            }
            
        } else{
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        } 
    }

    /**
     * This method is used to purchase a subscription
     * @param int $subscriptionCod The code of the subscription to purchase
     * @return void
     */
    public static function purchase(int $subscriptionCod): void {
        if(!CUser::isLogged()){
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        }
        if (!CUser::isSubbed()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $subscription = FPersistentManager::getInstance()->retrieveObjById(ESubscription::class, $subscriptionCod);
            $card = self::getCreditCard();
            $points = EPurchase::calculateDiscount($subscription->getPrice(), $user->getPlotCard()->getPoints());
            $user->getPlotCard()->setPoints($user->getPlotCard()->getPoints() - ($points / POINTS_MULTIPLIER));
            if (strtolower($subscription->getType()) === 'writer' ){
                $writer = $user->setPrivilege(2);
                FPersistentManager::getInstance()->updateObject(EUser::class, $writer, 'privilege', WRITER); 
            }else{
                $reader = $user->setPrivilege(1);
                FPersistentManager::getInstance()->updateObject(EUser::class, $reader, 'privilege', READER);
            }
            VPurchase::buy(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), $points, $subscription, $card);
        }
        else {
            header('Location: https://digitalplot.altervista.org/home');
            exit();
        }
    }

    /**
     * This method retrieves the credit card information from the POST request
     * and creates a new ECreditCard object, saving it in the database.
     * @return ECreditCard The created credit card object
     */
    public static function getCreditCard(): ECreditCard {
        $cardNumber = UHTTPMethods::post('cardNumber');
        $nameC = UHTTPMethods::post('nameC');
        $surnameC = UHTTPMethods::post('surnameC');
        $expiration = UHTTPMethods::post('expirationDate');
        $cvv = UHTTPMethods::post('cvv');
        $card = new ECreditCard($cardNumber, $nameC, $surnameC, $expiration, $cvv);
        FPersistentManager::getInstance()->saveInDb($card);
        return $card;
    }
}