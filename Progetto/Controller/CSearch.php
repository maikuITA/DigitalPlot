<?php
class CSearch {

    /**
     * Method to take value in the search screen
     * @return void
     */
    public static function takeValueArticle(): void {
        // Check if the user is logged in
        if (CUser::isLogged()) {
            $title = UHTTPMethods::post(['title']);
            $type = UHTTPMethods::post(['type']);
            $genre = UHTTPMethods::post(['genre']);
            $date = UHTTPMethods::post(['date']);
            $ris =  CSearch::emptyValues($title, $type, $genre, $date);
        } else {
            // If the user is not logged in, redirect to the authentication page
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }

    /**
     * Method to check if the values are empty
     * @param string $title
     * @param string $type
     * @param string $genre
     * @param string $date
     * @return void
     */
    public static function emptyValues(string $title, string $type, string $genre, string $date): void {
        if($title === '') {
            $title = '%';
        } elseif ($genre === '') {
            $genre = '%';
        } elseif ($type === '') {
            $type = '%';
        } elseif ($date === '') {
            $date = '%';
        }
            $result = FPersistentManager::getInstance()->searchArticles($title, $type, $genre, $date);
            VSearch::displaySearchResults(articles: $result);    
    }

    /**
     * Method to authenticate the user
     * This method checks if the VUser view exists and calls its auth method.
     * If the VUser view does not exist, it logs an error message.
     * This method is used to display the authentication page for users.
     * @return void
     */
    public static function find(): void {
        if(file_exists(__DIR__ . '/../View/VSearch.php') && method_exists('VSearch', 'find')) {
            VSearch::find(CUser::isLogged());
        } else {
            ULogSys::toLog("VSearch file not found", true);
        }
    }


     
}


?>