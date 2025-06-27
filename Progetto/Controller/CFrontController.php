<?php

class CFrontController {

    /**
     * This class is responsible for routing requests to the appropriate controllers and methods.
     * It uses a static array to define the routes and their corresponding controllers and methods.
     */
    private static $routes = [
        '' => ['CUser', 'home'], // Default route
        'dashboard' => ['CDashboard', 'dashboard'],
        'dashboardUpdate' => ['CDashboard', 'dashboardUpdate'],
        'home' => ['CUser', 'home'],
        'auth' => ['CUser', 'auth'],
        'subscribe' => ['CSubscribe', 'subscribe'],
        'startPurchase' => ['CPurchase', 'startPurchase'],
        'purchase' => ['CPurchase', 'purchase'],
        'error' => ['CError', 'error'],
        'confirm' => ['CConfirm', 'confirm'],
        'checkLogin' => ['CUser', 'checklogin'],
        'registrazione' => ['CUser', 'register'],
        'profile' => ['CUser', 'goToProfile'],
        'modifyProfile' => ['CUser', 'modifyProfile'],
        'applyModify' => ['CUser', 'applyModify'],
        'uploadAvatar' => ['CUser', 'uploadAvatar'],
        'dbInit'  => ['CService', 'dbInit'],
        'logs' => ['CService', 'logs'],
        'find' => ['CSearch', 'find'],
        'logout' => ['CUser', 'logout'],
        'search' => ['CSearch', 'takeValueArticle'],
        'article' => ['CArticle', 'showArticle'],
        'newArticle' => ['CArticle', 'newArticle'],
        'saveArticle' => ['CArticle', 'saveArticle'],
        'dropArticle'=> ['CArticle', 'dropArticle'],
        'modifyArticle'=> ['CArticle', 'modifyArticle'],
        'saveUpdate'=> ['CArticle', 'saveUpdateArticle'],
        'newReview'=> ['CArticle', 'newRewiew'],
        'dropReview'=> ['CArticle', 'dropReview'],
        'follow' => ['CFollow', 'follow'],
        'unfollow' => ['CFollow', 'unfollow'],
        'isFollow' => ['CFollow', 'isFollow'],
        'clearcache' => ['CService', 'clearCache'],
    ];
    
    /**
     * This method starts the front controller and routes the request to the appropriate controller and method.
     * It retrieves the request URI, trims it, and checks if it exists in the routes array.
     * If it exists, it calls the corresponding controller and method; otherwise, it redirects to a 404 error page.
     * @return void
     */
    public function start(): void {
        $requestUri = UServer::getValue('REQUEST_URI');
        $route = explode('/', trim($requestUri, '/')); // Split the URI into parts
        ULogSys::toLog("");
        ULogSys::toLog("Rotta -> /".$route[0]);
        if(self::hasMatchingKey(self::$routes, $route)) {
            $controller = self::$routes[$route[0]][0];
            $method = self::$routes[$route[0]][1];
            $params = array_slice($route, 1); // Get any additional parameters from the URL
            ULogSys::toLog("Controller -> ".$controller);
            ULogSys::toLog("Metodo -> ".$method);
            if (class_exists($controller) && method_exists($controller, $method)) {
                //try{
                    call_user_func_array([$controller, $method], $params);
                /*}catch(Exception $e){
                    ULogSys::toLog("Error front controller: ". $e->getMessage());
                    header('Location: https://digitalplot.altervista.org/error');
                    exit;
                }*/
            } else {
                ULogSys::toLog("Controller o metodo non trovato: " . $controller . " -> " . $method);
                header('Location: https://digitalplot.altervista.org/error/404');
                exit;
            }
        } else {
            ULogSys::toLog("Errore, display pagina errore 404");
            header('Location: https://digitalplot.altervista.org/error/404');
            exit;
        }
    }

    /**
     * This method checks if the given route exists in the routes array.
     * It iterates through the keys of the routes array and compares them with the first element of the route.
     * @param array $routes The array of defined routes.
     * @param array $route The route to check.
     * @return bool Returns true if a matching key is found, otherwise false.
     */
    public static function hasMatchingKey(array $routes, array $route): bool {
        foreach (array_keys($routes) as $key) {
            if ($key === $route[0]) {
                return true;
            }
        }
        return false;
    }

}