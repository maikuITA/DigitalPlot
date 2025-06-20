<?php

class CError {
    
    /**
     * Method to handle 404 errors
     * This method will redirect the user to a custom 404 error page.
     * @return void
     */
    public static function error404(): void {
        if(CUser::isLogged()) {
            VError::render("404 Not Found", true);
        } else {
            VError::render("404 Not Found", false);
        }
        ULogSys::toLog("404 Internal Server Error", true);
        exit;
    }
    
    /**
     * Method to handle 500 errors
     * This method will redirect the user to a custom 500 error page.
     * @return void
     */
    public static function error500(): void {
        if(CUser::isLogged()) {
            VError::render("500 Internal Server Error", true);
        } else {
            VError::render("500 Internal Server Error", false);
        }
        ULogSys::toLog("500 Internal Server Error", true);
        exit;       
    }
}