<?php

class CGuest{

    /**
     * make the registration
     * @return void
     */
    public static function register(): void {
        // Check if the request method is POST
        $method = UServer::getRequestMethod();
        if ($method === 'POST') {
            $telephone = UHTTPMethods::post('telephone');
            $username = UHTTPMethods::post('username');
            $email = UHTTPMethods::post('email');
            $password = UHTTPMethods::post('password');
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $birthdate = UHTTPMethods::post('birthdate');
            $birthplace = UHTTPMethods::post('birthplace');
            $biography = UHTTPMethods::post('biography'); 
            $user = new EUser($username, $password, $name, $surname, false, $birthdate, $birthplace, $email, $telephone, $biography);
            $plotCard = new EPlotCard( 0 , $user );
            $user->addPlotCard($plotCard);
            try {
                FPersistentManager::getInstance()->saveInBd($user);
                FPersistentManager::getInstance()->saveInBd($plotCard);
                USession::getInstance();
                USession::setSessionElement('user', $user->getId());
            } catch (Exception $e) {
                ULogSys::toLog('Error during registration: ' . $e->getMessage());
                header('Location: https://digitalplot.altervista.org/home');
            }
            header('Location: https://digitalplot.altervista.org/home');
        }
    }
}

