<?php
class CSearch {

    /**
     * Method to search for a user by username
     * @return void
     */
    public static function searchArticle(): void {
        // Check if the user is logged in
        if (CUser::isLogged()) {;
            $title = UHTTPMethods::post(['title']);
            $type = UHTTPMethods::post(['type']);
            $genre = UHTTPMethods::post(['genre']);
            $date = UHTTPMethods::post(['date']);
            $articlesSearched = FPersistentManager::getInstance()->searchArticles($title, $type, $genre, $date);
            VSearch::displaySearchResults(articles: $articlesSearched, title: $title, type: $type, genre: $genre, date: $date);
        } else {
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }
}


?>