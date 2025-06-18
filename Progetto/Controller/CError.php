<?php

class CError {
    
    /**
     * Method to handle 404 errors
     * This method will redirect the user to a custom 404 error page.
     * @return void
     */
    public static function error404(): void {
        header('HTTP/1.1 404 Not Found');
        // chiama la view per la pagina di errore 404
        exit;
    }
    
    /**
     * Method to handle 500 errors
     * This method will redirect the user to a custom 500 error page.
     * @return void
     */
    public static function error500(): void {
        header('HTTP/1.1 500 Internal Server Error');
        // chiama la view per la pagina di errore 500
        exit;       
    }
}