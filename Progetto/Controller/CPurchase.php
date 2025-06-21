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
                $points = self::verifyPoints($user->getPlotCard()->getPoints(), $subscription->getPrice());
                VPurchase::startPurchase(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), false, $subscription, $points);
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
            $points = self::verifyPoints($user->getPlotCard()->getPoints(), $subscription->getPrice());
            $user->getPlotCard()->setPoints($user->getPlotCard()->getPoints() - ($points / POINTS_MULTIPLIER));
            if (strtolower($subscription->getType()) == 'writer' ){
                $writer = self::createWriter($user);
                FPersistentManager::getInstance()->saveInDb($writer);
            }else{
                $reader = self::createReader($user);
                FPersistentManager::getInstance()->saveInDb($reader);
            }
            VPurchase::buy(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), true, $points, $subscription, $card);
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
        $name = UHTTPMethods::post('name');
        $surname = UHTTPMethods::post('surname');
        $expiration = UHTTPMethods::post('expirationDate');
        $cvv = UHTTPMethods::post('cvv');
        $card = new ECreditCard($cardNumber, $name, $surname, $expiration, $cvv);
        FPersistentManager::getInstance()->saveInDb($card);
        return $card;
    }

    /**
     * This method verifies if the points are enough to cover the price of the subscription.
     * If the points are enough, it returns the total value of the points used.
     * If not, it returns the price of the subscription.
     * @param int $points The number of points available
     * @param float $price The price of the subscription
     * @return float The value of points used or the price of the subscription
     */
    public static function verifyPoints(int $points, float $price): float {
        $difference = $price - ($points * POINTS_MULTIPLIER);
        $result = $points * POINTS_MULTIPLIER;
        if ($difference > 0) {
            return $result; 
        } else{
            return $price;
        }
    }


    public static function createWriter(EUser $user): EWriter {
        
        $writer = new EWriter($user->getUsername(), 
                                $user->getPassword(), 
                                $user->getName(), 
                                $user->getSurname(),
                                $user->getBirthdate()->format('Y-m-d'),
                                $user->getStreetAddress(),
                                $user->getBirthplace(),
                                $user->getEmail(),
                                $user->getTelephone(),
                                $user->getBiography());
        $writer->setId($user->getId());
        $writer->addPlotCard($user->getPlotCard());
        $writer->setProfilePicture($user->getEncodedData());
        foreach ($user->getReadings() as $reading) {
            $writer->addReading($reading);
        }
        return $writer;
    }


     public static function createReader(EUser $user): EReader {
        
        $reader = new EReader($user->getUsername(), 
                            $user->getPassword(), 
                            $user->getName(), 
                            $user->getSurname(),
                            $user->getBirthdate()->format('Y-m-d'),
                            $user->getStreetAddress(),
                            $user->getBirthplace(),
                            $user->getEmail(),
                            $user->getTelephone(),
                            $user->getBiography());
    $reader->setId($user->getId());
    $reader->addPlotCard($user->getPlotCard());
    $reader->setProfilePicture($user->getEncodedData());
    foreach ($user->getReadings() as $reading) {
        $reader->addReading($reading);
    }
    return $reader;

    }
}