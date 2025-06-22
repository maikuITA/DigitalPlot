<?php

class CFrontController {

    /**
     * This class is responsible for routing requests to the appropriate controllers and methods.
     * It uses a static array to define the routes and their corresponding controllers and methods.
     */
    private static $routes = [
        '' => ['CUser', 'home'], // Default route
        'dashboard' => ['CDashboard', 'dashboard'],
        'home' => ['CUser', 'home'],
        'auth' => ['CUser', 'auth'],
        'subscribe' => ['CSubscribe', 'subscribe'],
        'startPurchase' => ['CPurchase', 'startPurchase'],
        'purchase' => ['CPurchase', 'purchase'],
        'error' => ['CError', 'error404'],
        'checkLogin' => ['CUser', 'checklogin'],
        'registrazione' => ['CUser', 'register'],
        'profile' => ['CUser', 'goToProfile'],
        'dbInit'  => ['CService', 'dbInit'],
        'logs' => ['CService', 'logs'],
        'find' => ['CSearch', 'find'],
        'logout' => ['CUser', 'logout'],
        'search' => ['CSearch', 'takeValueArticle'],
        'article' => ['CArticle', 'showArticle'],
        'newArticle' => ['CArticle', 'newArticle'],
        'dropArticle'=> ['CArticle', 'dropArticle'],
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
        ULogSys::toLog("Rotta: ".$route[0]);
        if(self::hasMatchingKey(self::$routes, $route)) {
            $controller = self::$routes[$route[0]][0];
            $method = self::$routes[$route[0]][1];
            $params = array_slice($route, 1); // Get any additional parameters from the URL
            ULogSys::toLog("Controller -> ".$controller . " # Method -> ".$method);
            if (class_exists($controller) && method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                header('Location: https://digitalplot.altervista.org/error');
            }
        } else {
            header('Location: https://digitalplot.altervista.org/error');
        }
    }

    public static function hasMatchingKey(array $routes, array $route): bool {
        foreach (array_keys($routes) as $key) {
            if ($key === $route[0]) {
                return true;
            }
        }
        return false;
    }

}