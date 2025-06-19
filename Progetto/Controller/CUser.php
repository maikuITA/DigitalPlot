<?php

class CUser{

    /**
     * check if the user is logged (using session)
     * @return boolean
     */
    public static function isLogged() : bool {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        if(!$logged){
            header('Location: /DigitalPlot/Guest/home');
            exit;
        }
        return true;
    }

    /**
     * Method to redirect to the home page of the user
     * @return void
     */
    public static function home(): void {
        if(self::isLogged()){
            $user = FPersistentManager::getInstance()->retriveObjById(EUser::class, USession::getSessionElement('user'));
            VUser::home($user->getUsername());
        }  
    }

    
}