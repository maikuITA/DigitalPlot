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
                $points = EPurchase::calculateDiscount($subscription, $user->getPlotCard()->getPoints());
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
            //retriving all object
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $subscription = FPersistentManager::getInstance()->retrieveObjById(ESubscription::class, $subscriptionCod);
            $card = self::getCreditCard();
            // verify if credit card already exists in db
            if (FPersistentManager::getInstance()->retrieveObjById(ECreditCard::class, $card->getCardNumber()) === false){
                FPersistentManager::getInstance()->saveInDb($card);
            }
            $purchase =  self::validatePurchase($user, $subscription, $card);
            //calculating discuont and update all object
            $points = EPurchase::calculateDiscount($subscription, $user->getPlotCard()->getPoints());
            $user->getPlotCard()->setPoints($user->getPlotCard()->getPoints() - ($points / POINTS_MULTIPLIER));
            $user->addPurchase($purchase);   
            $card->addPurchase($purchase);                      
            $subscription->addPurchase($purchase); 
            //saving in db              
            FPersistentManager::getInstance()->saveInDb($purchase);
            FPersistentManager::getInstance()->saveInDb($subscription);
            FPersistentManager::getInstance()->saveInDb($user);
            //upgrade the user
            if (strtolower($subscription->getType()) === 'writer' ){
                FPersistentManager::getInstance()->updateObject(EUser::class, $user->getId(), 'privilege', WRITER); 
            }else{
                FPersistentManager::getInstance()->updateObject(EUser::class, $user->getId(), 'privilege', READER);
            }
            //showing the view
            $messaggio = "Grazie ".$user->getUsername(). " per esserti abbonato!";
            VConfirm::render( $messaggio, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), true);
            exit;
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
    private static function getCreditCard(): ECreditCard {
        $cardNumber = UHTTPMethods::post('cardNumber');
        $nameC = UHTTPMethods::post('nameC');
        $surnameC = UHTTPMethods::post('surnameC');
        $expiration = UHTTPMethods::post('expirationDate');
        $cvv = UHTTPMethods::post('cvv');
        $card = new ECreditCard($cardNumber, $nameC, $surnameC, $expiration, $cvv);
        return $card;
    }


    private static function validatePurchase(EUser $user, ESubscription $subscription, ECreditCard $card): EPurchase{
        $currentdate = date('Y-m-g');
        $country = UHTTPMethods::post('country');
        $city = UHTTPMethods::post('city');
        $province = UHTTPMethods::post('province');
        $zipCode = UHTTPMethods::post('zipCode');
        $billingAddress = UHTTPMethods::post('billingAddress');
        $streetNumber = UHTTPMethods::post('streetNumber');
        $expirationDate = date('Y-m-d', strtotime("+".$subscription->getPeriod()));
        return new EPurchase( $currentdate , $expirationDate, $country, $city, $province, $zipCode, $billingAddress, $streetNumber, $user, $subscription, $card );
    }
}