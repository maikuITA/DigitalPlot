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
        if(empty($title) && empty($type) && empty($genre) && !empty($date)) {
            $result = FPersistentManager::getInstance()->searchArticlesNoDate($title, $type, $genre);
        } elseif (empty($title) && empty($type) && !empty($genre) && empty($date)) {
            $result = FPersistentManager::getInstance()->searchArticlesNoGenre($title, $type, $date);
        } elseif (empty($title) && !empty($type) && empty($genre) && empty($date)) {
            $result = FPersistentManager::getInstance()->searchArticlesNoType($title, $genre, $date);
        } elseif (!empty($title) && empty($type) && empty($genre) && empty($date)) {
           $result = FPersistentManager::getInstance()->searchArticlesNoTitle($type, $genre, $date);
        } elseif (!empty($title) && !empty($type) && empty($genre) && empty($date)) {
            $result = FPersistentManager::getInstance()->searchArticlesNoTitleNoType($genre, $date);
        } elseif (!empty($title) && !empty($type) && !empty($genre) && empty($date)) {
            $result = FPersistentManager::getInstance()->searchArticlesOnlyDate($date);
        } else {
            $result = FPersistentManager::getInstance()->searchArticles($title, $type, $genre, $date);
            VSearch::displaySearchResults(articles: $result);
        }
       
    }


     
}


?>