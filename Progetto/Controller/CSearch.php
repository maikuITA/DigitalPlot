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


     
}


?>