<?php

class CPurchase
{

    /**
     * This class launch the purchase form
     * @param int $subscriptionCod The code of the subscription to purchase
     * @return void
     */
    public static function startPurchase(int $subscriptionCod = -1): void
    {
        if ($subscriptionCod === null || $subscriptionCod <= 0) {
            header('Location: /errors/404');
            exit();
        }
        $subscription = FPersistentManager::getInstance()->retrieveObjById(ESubscription::class, $subscriptionCod);
        if (!isset($subscription)) {
            header('Location: /errors/404');
            exit();
        }
        if (CUser::isLogged()) {
            if (!CUser::isSubbed()) {
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                $points = EPurchase::calculateDiscount($subscription, $user->getPlotCard()->getPoints());
                VPurchase::startPurchase($user, true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), $subscription, $points);
            } else {
                header('Location: /home');
                exit();
            }
        } else {
            header('Location: /auth');
            exit();
        }
    }

    /**
     * This method is used to purchase a subscription
     * It retrieves the subscription and user information, validates the credit card,
     * calculates the discount, updates the user's plot card points, and saves the purchase in the database.
     * If the purchase is successful, it redirects to a confirmation page.
     * If the user is not logged in or already subscribed, it redirects to the appropriate page
     * @param int $subscriptionCod The code of the subscription to purchase
     * @return void
     */
    public static function purchase(int $subscriptionCod = -1): void
    {
        if ($subscriptionCod === null || $subscriptionCod <= 0) {
            header('Location: /errors/404');
            exit();
        }
        if (!CUser::isLogged()) {
            header('Location: /auth');
            exit();
        }
        if (!CUser::isSubbed()) {
            //retriving all object
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $subscription = FPersistentManager::getInstance()->retrieveObjById(ESubscription::class, $subscriptionCod);
            $card = self::getCreditCard();
            $possibleCard = FPersistentManager::getInstance()->retrieveObjById(ECreditCard::class, $card->getCardNumber());
            // verify if credit card already exists in db, if yes, take the card from it
            if (!isset($possibleCard)) {
                FPersistentManager::getInstance()->saveInDb($card);
            } else {
                $card = $possibleCard;
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
            if (strtolower($subscription->getType()) === 'writer') {
                FPersistentManager::getInstance()->updateObject(EUser::class, $user->getId(), 'privilege', WRITER);
            } else {
                FPersistentManager::getInstance()->updateObject(EUser::class, $user->getId(), 'privilege', READER);
            }
            //showing the view
            header('Location: /confirm/4');
            exit;
        } else {
            header('Location: /home');
            exit();
        }
    }

    /**
     * This method retrieves the credit card information from the POST request
     * and creates a new ECreditCard object.
     * @return ECreditCard The created credit card object
     */
    private static function getCreditCard(): ECreditCard
    {
        $cardNumber = UHTTPMethods::post('cardNumber');
        $nameC = UHTTPMethods::post('nameC');
        $surnameC = UHTTPMethods::post('surnameC');
        $expiration = UHTTPMethods::post('expirationDate');
        $cvv = UHTTPMethods::post('cvv');
        $card = new ECreditCard($cardNumber, $nameC, $surnameC, $expiration, $cvv);
        return $card;
    }

    /**
     * This method validates the purchase by creating a new EPurchase object
     * with the current date, expiration date, billing information, user, subscription, and credit card.
     * @param EUser $user The user making the purchase
     * @param ESubscription $subscription The subscription being purchased
     * @param ECreditCard $card The credit card used for the purchase
     * @return EPurchase The created purchase object
     */
    private static function validatePurchase(EUser $user, ESubscription $subscription, ECreditCard $card): EPurchase
    {
        $currentdate = date('Y-m-g');
        $country = UHTTPMethods::post('country');
        $city = UHTTPMethods::post('city');
        $province = UHTTPMethods::post('province');
        $zipCode = UHTTPMethods::post('zipCode');
        $billingAddress = UHTTPMethods::post('billingAddress');
        $streetNumber = UHTTPMethods::post('streetNumber');
        $expirationDate = date('Y-m-d', strtotime("+" . $subscription->getPeriod()));
        return new EPurchase($currentdate, $expirationDate, $country, $city, $province, $zipCode, $billingAddress, $streetNumber, $user, $subscription, $card);
    }
}
