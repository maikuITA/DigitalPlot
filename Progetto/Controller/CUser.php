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
            header('Location: https://digitalplot.altervista.org/home');
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
            $articles = FPersistentManager::getInstance()->getCasualArticles(8);
            VUser::home(username: $user->getUsername(), plotPoints: $user->getPlocard()->getPoints(), proPic: $user->getEncodedData(), articles: $articles);
        }  
    }


    /**
     * Method to redirect to the login page
     */
     public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: https://digitalplot.altervista.org/home');
    }
    
}