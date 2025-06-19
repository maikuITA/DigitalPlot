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
            if (FPersistentManager::getInstance()->checkIfExistTelephone($telephone)){
                ULogSys::toLog("Telephone already exists: $telephone", true);
                // richiamo della view login con messaggio di errore
                exit;
            } else {
                $username = UHTTPMethods::post('username');
                if (FPersistentManager::getInstance()->checkIfExistUsername($username)){
                    ULogSys::toLog("Username already exists: $username", true);
                    // richiamo della view login con messaggio di erroreù
                    exit;
                } else{
                    $email = UHTTPMethods::post('email');
                    $password = UHTTPMethods::post('password');
                    $name = UHTTPMethods::post('name');
                    $surname = UHTTPMethods::post('surname');
                    $birthdate = UHTTPMethods::post('birthdate');
                    $birthplace = UHTTPMethods::post('birthplace');
                    $biography = UHTTPMethods::post('biography'); 
                    $user = new EUser($username, $password, $name, $surname, $birthdate, $birthplace, $email, $telephone, $biography);
                    FPersistentManager::getInstance()->saveInBd($user);
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    CUser::home();
                }
            }
        }
    }
}

