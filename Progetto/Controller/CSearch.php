<?php
class CSearch
{

    /**
     * Method to take value in the search screen
     * @return void
     */
    public static function takeValueArticle(): void
    {
        // Check if the user is logged in
        if (CUser::isLogged()) {
            if (CUser::isSubbed()) {
                $title = UHTTPMethods::post('title');
                $category = UHTTPMethods::post('category');
                $genre = UHTTPMethods::post('genre');
                $releaseDate = UHTTPMethods::post('releaseDate');
                CSearch::emptyValues($title, $category, $genre, $releaseDate);
            } else {
                header('Location: https://digitalplot.altervista.org/home');
            }
        } else {
            // If the user is not logged in, redirect to the authentication page
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }

    /**
     * Method to search articles based on the provided parameters
     * @param string $title
     * @param string $type
     * @param string $genre
     * @param string $date
     * @return void
     */
    public static function emptyValues(string $title, string $category, string $genre, string $releaseDate): void
    {
        $title = trim($title);
        $title = "%" . $title . "%";
        $result = FPersistentManager::getInstance()->searchArticles($title, $category, $genre, $releaseDate);
        $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
        VSearch::displaySearchResults($result, true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege());
    }

    /**
     * Method that veryfies if the user is logged in and subscribed
     * If so, it allows the user to search for articles
     * If not, it redirects to the authentication page
     * @return void
     */
    public static function find(): void
    {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if (CUser::isSubbed()) {
                VSearch::find(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege());
            } else {
                header('Location: https://digitalplot.altervista.org/home');
            }
        } else {
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }
}
