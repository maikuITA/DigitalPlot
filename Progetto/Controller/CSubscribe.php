<?php

class CSubscribe {
    
    /**
     * Method to render the subscription view
     * This method checks if the VSubscribe view file exists and renders it.
     * If the file does not exist, it logs an error message.
     * @param bool $isLogged Indicates if the user is logged in
     * @return void
     */
    public static function subscribe(): void {
        if(CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retriveObjById(EUser::class, USession::getSessionElement('user'));
            if(CUser::isSubbed()){
                VSubscribe::render(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), true);
            }
            else {
                VSubscribe::render(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), false);
            }
        } else {
            header('Location: https://digitalplot.altervista.org/auth');
            exit;
        }
        
    }

}