<?php

class CSubscribe {
    
    /**
     * Method to render the subscription view
     * This method checks if the VSubscribe view file exists and renders it.
     * If the file does not exist, it logs an error message.
     * @return void
     */
    public static function subscribe(): void {
        if(CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $subs = FPersistentManager::getInstance()->retrieveAllSubscriptions();
            if(CUser::isSubbed()){
                header('Location: https://digitalplot.altervista.org/home');
                exit;
            }
            else {
                VSubscribe::render(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), false, $subs);
            }
        } else {
            header('Location: https://digitalplot.altervista.org/auth');
            exit;
        }
        
    }

}