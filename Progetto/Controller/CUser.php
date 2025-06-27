<?php
require_once (__DIR__ . "/../Utility/config.php");


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
        if (CUser::isLogged() === true){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            USession::getInstance();
            USession::unsetSession();
            USession::destroySession();
            header('Location: https://digitalplot.altervista.org/confirm/5');
        } else {
            header('Location: https://digitalplot.altervista.org/home');
        }
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
            $user = new EUser (privilege: BASIC, username: $username, password: $password,name: $name,surname: $surname, birthdate: $birthdate,country: $country,birthplace: $birthplace,province: $province,zipCode: $zipCode,streetAddress: $streetAddress,streetNumber: $streetNumber,email: $email,telephone: $telephone);
            $plotCard = new EPlotCard( 0 , $user );
            $user->addPlotCard($plotCard);
            try {
                FPersistentManager::getInstance()->saveInDb($user);
                FPersistentManager::getInstance()->saveInDb($plotCard);
                USession::getInstance();
                USession::setSessionElement('user', $user->getId());
            } catch (Exception $e) {
                ULogSys::toLog('Error during registration: ' . $e->getMessage());
                header('Location: https://digitalplot.altervista.org/auth');
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
                    ULogSys::toLog("Nuovo login");
                    ULogSys::toLog("");
                    header('Location: https://digitalplot.altervista.org/home');
                } else {
                    ULogSys::toLog('Invalid username or password', true);
                    header('Location: https://digitalplot.altervista.org/auth');
                    exit;
                }
            } catch (Exception $e) {
                ULogSys::toLog('Error during login: ' . $e->getMessage(), true);
                header('Location: https://digitalplot.altervista.org/auth');
                exit;
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
            $comments = $user->getReviews();
            VProfile::render(user: $user, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), isLogged:true, privilege: $user->getPrivilege(), articles: $articles, readdenArticles: $readdenArticles, reviews: $comments);

        } else {
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }


    public static function uploadAvatar(): void {
        // the input of files is the value of "name", attribute in <input type = "file" ...
        if (CUser::isLogged() === true){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $image = UHTTPMethods::files('avatar');
            if (!empty($image) && $image['error'] === UPLOAD_ERR_OK && !empty($image['tmp_name'])) {
                $tmpName = $image['tmp_name'];

                // Verifica MIME
                $mime = mime_content_type($tmpName);
                $allowed = ['image/jpeg', 'image/png', 'image/webp'];
                if (!in_array($mime, $allowed)) {
                    header('Location: https://digitalplot.altervista.org/error/2');
                    exit;
                }

                // Verifica dimensione (es. max 2MB)
                if ($image['size'] > 2 * 1024 * 1024) {
                    header('Location: https://digitalplot.altervista.org/error/3');
                    exit;
                }

                // OK: leggi contenuto binario
                $blob = file_get_contents($tmpName);

                FPersistentManager::getInstance()->updateObject(EUser::class, $user->getId(), 'profilePicture', $blob); 
                ULogSys::toLog("Immagine di profilo updatata");
                ULogSys::toLog("");
                header("Location: https://digitalplot.altervista.org/profile");
                exit;
            } else {
                header('Location: https://digitalplot.altervista.org/error/5');
                exit;
            }

        } else {
            header('Location: https://digitalplot.altervista.org/auth');
            exit;
        }
    }

    public static function editProfile(){
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            VProfile::editProfile(user: $user, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), isLogged:true, privilege: $user->getPrivilege());
        }
    }

    public static function applyModify(){
        if(UServer::getRequestMethod() === 'POST'){
            if(CUser::isLogged()){
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                if(UHTTPMethods::post('username') === ""){
                    $username = $user->getUsername();
                }
                else{
                    $username = UHTTPMethods::post('username');
                }
                if(UHTTPMethods::post('biography') === ""){
                    $biography = $user->getBiography();
                }else{
                    $biography = UHTTPMethods::post('biography');
                }
                if(UHTTPMethods::post('new-password') === UHTTPMethods::post('new-password2') && password_verify(UHTTPMethods::post('old-password'),$user->getPassword())){
                    $user->setUsername($username);
                    $user->setPassword(UHTTPMethods::post('new-password'));
                    $user->setBiography($biography);
                    FPersistentManager::getInstance()->saveInDb($user);
                    header('Location: https://digitalplot.altervista.org/confirm/8');
                }elseif(UHTTPMethods::post('old-password') === ''){
                    $user->setUsername($username);
                    $user->setBiography($biography);
                    FPersistentManager::getInstance()->saveInDb($user);
                    header('Location: https://digitalplot.altervista.org/confirm/8');
                }else{
                    header('Location: https://digitalplot.altervista.org/editProfile');
                    exit;
                }
            }else{
                header('Location: https://digitalplot.altervista.org/auth');
                exit;
            }
        }else{
            header('Location: https://digitalplot.altervista.org/error/404');
            exit;
        }
        
    }



}