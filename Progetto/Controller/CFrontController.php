<?php

class CFrontController {

    /**
     * This class is responsible for routing requests to the appropriate controllers and methods.
     * It uses a static array to define the routes and their corresponding controllers and methods.
     */
    private static $routes = [
        '' => ['CUser', 'home'], // Default route
        'home' => ['CUser', 'home'],
        'auth' => ['CUser', 'auth'],
        'subscribe' => ['CSubscribe', 'subscribe'],
        'error' => ['CError', 'error404'],
        'login' => ['CUser', 'checklogin'],
        'registrazione' => ['CUser', 'register'],
        'dbInit'  => ['CService', 'dbInit'],
        'logs' => ['CService', 'logs'],
        'find' => ['CSearch', 'find'],
        'logout' => ['CUser', 'logout'],
        'search' => ['CSearch', 'takeValueArticle'],
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
        $route = trim($requestUri, '/');
        ULogSys::toLog("Rotta:".$route);
        if(in_array($route, array_keys(self::$routes))) {
            $controller = self::$routes[$route][0];
            $method = self::$routes[$route][1];
            ULogSys::toLog("Controller -> ".$controller . " # Method -> ".$method);
            if (class_exists($controller) && method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], []);
            } else {
                header('Location: https://digitalplot.altervista.org/error');
            }
        } else {
            header('Location: https://digitalplot.altervista.org/error');
        }
    }
}