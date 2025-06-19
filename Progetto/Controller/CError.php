<?php

class CError {
    
    /**
     * Method to handle 404 errors
     * This method will redirect the user to a custom 404 error page.
     * @return void
     */
    public static function error404(): void {
        VError::render("404 Not Found");
        //header('HTTP/1.1 404 Not Found');
        exit;
    }
    
    /**
     * Method to handle 500 errors
     * This method will redirect the user to a custom 500 error page.
     * @return void
     */
    public static function error500(): void {
        VError::render("500 Internal Server Error");
        //header('HTTP/1.1 500 Internal Server Error');
        exit;       
    }
}