<?php
class CUser{

    /**
     * Method to check if the user is logged in
     * This method checks if the session is set and if the user session element exists.
     * @return boolean
     */
    public static function isLogged() : bool {
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            return true;
        }
        return false;
    }

    /**
     * Method to check if the user is subscribed
     * This method retrieves the user from the persistent manager using the session element 'user',
     * and checks if the user is subscribed.
     * It returns true if the user is subscribed, otherwise false.
     * @return boolean
     */
    public static function isSubbed(): bool {
        return FPersistentManager::getInstance()->isSubbed(USession::getSessionElement('user'));
    }

    /**
     * Method to check if the user is an admin
     * This method retrieves the user from the persistent manager using the session element 'user',
     * and checks if the user has admin privileges.
     * It returns true if the user is an admin, otherwise false.
     * @return boolean
     */
    public static function isAdmin(): bool {
        $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
        if ($user->getPrivilege() === ADMIN){
            return true;
        }
        return false;
    }

    /**
     * Method to home the user for the first time
     * This method checks if the user is logged in and redirects accordingly.
     * If the user is logged in, it redirects to the user home page.
     * If the user is not logged in, it redirects to the guest home page.
     * @return void
     */
    public static function home(): void {
        if(self::isLogged()) {
            self::user();
        } else {
            self::guest();
        }
    }

    /**
     * Method to redirect to the home page of a logged user
     * This method retrieves the user data and casual articles,
     * and displays the home page for logged-in users.
     * @return void
     */
    public static function user(): void {
        $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
        $articles = FPersistentManager::getInstance()->getCasualArticles(8);
        if(self::isSubbed()){
            VUser::home(username: $user->getUsername(), plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), articles: $articles, isLogged:true, privilege: $user->getPrivilege());
        }
        else{
            VUser::home(username: $user->getUsername(), plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), articles: $articles, isLogged:true, privilege: $user->getPrivilege());
        }
    }

    /**
     * Method to redirect to the home page of a guest user
     * This method retrieves casual articles and displays the home page for guests.
     * It does not require any user session.
     * @return void
     */
    public static function guest(): void {
        $articles = FPersistentManager::getInstance()->getCasualArticles(8);
        VUser::home(articles: $articles);   
    }

    /**
     * Method to log out the user
     * This method destroys the user session and redirects to the home page.
     */
     public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: https://digitalplot.altervista.org/home');
    }

    /**
     * Method to register a new user
     * This method retrieves user data from the POST request,
     * creates a new user and plot card,
     * and saves them in the database.
     * @return void
     */
    public static function register(): void {
        // Check if the request method is POST
        $method = UServer::getRequestMethod();
        if ($method === 'POST') {
            $username = UHTTPMethods::post('username');
            $password = UHTTPMethods::post('password');
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $birthdate = UHTTPMethods::post('birthdate');
            $country = UHTTPMethods::post('country');
            $birthplace = UHTTPMethods::post('birthplace');
            $province = UHTTPMethods::post('province');
            $zipCode = UHTTPMethods::post('zipCode');
            $streetAddress = UHTTPMethods::post('streetAddress');
            $streetNumber = UHTTPMethods::post('streetNumber');
            $email = UHTTPMethods::post('email');
            $telephone = UHTTPMethods::post('telephone');
            $privilege = BASIC;
            $user = new EUser ($privilege, $username, $password, $name, $surname, $birthdate, $country, $birthplace, $province, $zipCode, $streetAddress, $streetNumber, $email, $telephone);
            $plotCard = new EPlotCard( 0 , $user );
            $user->addPlotCard($plotCard);
            try {
                FPersistentManager::getInstance()->saveInDb($user);
                FPersistentManager::getInstance()->saveInDb($plotCard);
                USession::getInstance();
                USession::setSessionElement('user', $user->getId());
            } catch (Exception $e) {
                ULogSys::toLog('Error during registration: ' . $e->getMessage());
                header('Location: https://digitalplot.altervista.org/home');
            }
            header('Location: https://digitalplot.altervista.org/home');
        }
        else {
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }

    /**
     * Method to authenticate the user
     * This method checks if the VUser view exists and calls its auth method.
     * If the VUser view does not exist, it logs an error message.
     * This method is used to display the authentication page for users.
     * @return void
     */
    public static function auth(): void {
        if(self::isLogged()) {
            header('Location: https://digitalplot.altervista.org/home');
            return;
        } else {
            VUser::auth();
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
                $user = FPersistentManager::getInstance()->retrieveUserOnUsername($username);
                if (isset($user) && password_verify($password, $user->getPassword())) {
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    header('Location: https://digitalplot.altervista.org/home');
                } else {
                    ULogSys::toLog('Invalid username or password', true);
                    header('Location: https://digitalplot.altervista.org/auth');
                }
            } catch (Exception $e) {
                ULogSys::toLog('Error during login: ' . $e->getMessage(), true);
                header('Location: https://digitalplot.altervista.org/auth');
            }
        } else{
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }

    /**
     * Method to redirect to the user profile page
     * This method checks if the user is logged in and retrieves the user data.
     * If the user is logged in, it renders the profile view with the user's data.
     * If the user is not logged in, it redirects to the authentication page.
     * @return void
     */
    public static function goToProfile(): void {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $articles = $user->getArticles();
            $readdenArticles = $user->getReaddenArticles();
            VProfile::render(user: $user, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), isLogged:true, privilege: $user->getPrivilege(), articles: $articles, readdenArticles: $readdenArticles);

        } else {
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }

}