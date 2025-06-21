<?php
class CSearch {

    /**
     * Method to take value in the search screen
     * @return void
     */
    public static function takeValueArticle(): void {
        // Check if the user is logged in
        if (CUser::isLogged()) {
            if(CUser::isSubbed()){
                $title = UHTTPMethods::post('title');
                $type = UHTTPMethods::post('type');
                $genre = UHTTPMethods::post('genre');
                $date = UHTTPMethods::post('date');
                CSearch::emptyValues($title, $type, $genre, $date);
            }else{
                header('Location: https://digitalplot.altervista.org/home');
            }
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
        $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
        VSearch::displaySearchResults( $result, true,$user->getPlotCard()->getPoints(), $user->getEncodedData(), true);    
    }

    /**
     * Method to authenticate the user
     * This method checks if the VUser view exists and calls its auth method.
     * If the VUser view does not exist, it logs an error message.
     * This method is used to display the authentication page for users.
     * @return void
     */
    public static function find(): void {
        if(CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if(CUser::isSubbed()){
                VSearch::find(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(),true);
            }
            else {
                header('Location: https://digitalplot.altervista.org/home');
            }
        } else {
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }


     
}


?>