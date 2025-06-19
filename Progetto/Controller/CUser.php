<?php

class CUser{

    /**
     * check if the user is logged (using session)
     * @return boolean
     */
    public static function isLogged() : bool {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        if(!$logged){
            header('Location: https://digitalplot.altervista.org/welcome');
            exit;
        }
        return true;
    }

    /**
     * Method to welcome the user for the first time
     * This method checks if the user is logged in and redirects accordingly.
     * @return void
     */
    public static function welcome(): void {
        $logged = false;
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        if(!$logged){
            VUser::home();
        } else {
            self::home();
        }
    }

    /**
     * Method to redirect to the home page of the user
     * @return void
     */
    public static function home(): void {
        if(self::isLogged()) {
            $user = FPersistentManager::getInstance()->retriveObjById(EUser::class, USession::getSessionElement('user'));
            $articles = FPersistentManager::getInstance()->getCasualArticles(8);
            VUser::home(username: $user->getUsername(), plotPoints: $user->getPlocard()->getPoints(), proPic: $user->getEncodedData(), articles: $articles, logged: USession::isSetSessionElement($user));
        }    
    }


    /**
     * Method to redirect to the login page
     */
     public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: https://digitalplot.altervista.org/home');
    }

    /**
     * make the registration
     * @return void
     */
    public static function register(): void {
        // Check if the request method is POST
        $method = UServer::getRequestMethod();
        if ($method === 'POST') {
            $telephone = UHTTPMethods::post('telephone');
            $username = UHTTPMethods::post('username');
            $email = UHTTPMethods::post('email');
            $password = UHTTPMethods::post('password');
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $birthdate = UHTTPMethods::post('birthdate');
            $birthplace = UHTTPMethods::post('birthplace');
            $biography = UHTTPMethods::post('biography'); 
            $user = new EUser($username, $password, $name, $surname, false, $birthdate, $birthplace, $email, $telephone, $biography);
            $plotCard = new EPlotCard( 0 , $user );
            $user->addPlotCard($plotCard);
            try {
                FPersistentManager::getInstance()->saveInBd($user);
                FPersistentManager::getInstance()->saveInBd($plotCard);
                USession::getInstance();
                USession::setSessionElement('user', $user->getId());
            } catch (Exception $e) {
                ULogSys::toLog('Error during registration: ' . $e->getMessage());
                header('Location: https://digitalplot.altervista.org/home');
            }
            header('Location: https://digitalplot.altervista.org/home');
        }
    }

    /**
     * Method to show the access page
     * @return void
     */
    public static function access(): void {
        if(file_exists(__DIR__ . '/../View/VUser.php') && method_exists('VUser', 'access')) {
            VUser::access();
        } else {
            ULogSys::toLog("VUser file not found", true);
        }
    }
    
    /**
     * Method to check the login credentials and log the user in
     * This method retrieves the username and password from the POST request,
     * verifies them against the database, and sets the session if successful.
     * If the credentials are invalid or an error occurs, it logs the error and redirects to the access page.
     * @return void
     * @throws Exception
     */
    public static function checklogin(): void{
        if (UServer::getRequestMethod() === 'POST') {
            $username = UHTTPMethods::post('username');
            $password = UHTTPMethods::post('password');
            try {
                $user = FPersistentManager::getInstance()->retriveObjById(EUser::class, $username);
                if ($user && password_verify($password, $user->getPassword())) {
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    header('Location: https://digitalplot.altervista.org/home');
                } else {
                    ULogSys::toLog('Invalid username or password');
                    header('Location: https://digitalplot.altervista.org/access');
                }
            } catch (Exception $e) {
                ULogSys::toLog('Error during login: ' . $e->getMessage());
                header('Location: https://digitalplot.altervista.org/access');
            }
        } elseif(UServer::getRequestMethod() === 'GET') {
            header('Location: https://digitalplot.altervista.org/access');
        }
    }

    

    
}