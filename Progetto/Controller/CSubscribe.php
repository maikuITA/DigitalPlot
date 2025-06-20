<?php

class CSubscribe {
    
    /**
     * Method to render the subscription view
     * This method checks if the VSubscribe view file exists and renders it.
     * If the file does not exist, it logs an error message.
     * @param bool $isLogged Indicates if the user is logged in
     * @return void
     */
    public static function subscribe($isLogged): void {
        if(file_exists(__DIR__ . '/../View/VSubscribe.php')) {
            VSubscribe::render($isLogged);
        } else {
            ULogSys::toLog("VSubscribe file not found", true);
        }
    }

}