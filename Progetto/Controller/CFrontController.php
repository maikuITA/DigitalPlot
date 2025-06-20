<?php

class CFrontController {

    private static $routes = [
        '' => ['CUser', 'welcome'], // Default route
        'home' => ['CUser', 'home'],
        'welcome' => ['CUser', 'welcome'],
        'auth' => ['CUser', 'auth'],
        'subscribe' => ['CSubscribe', 'subscribe'],
        'error' => ['CError', 'error404'],
        'login' => ['CUser', 'checklogin'],
        'registrazione' => ['CUser', 'register'],
        'dbInit'  => ['CService', 'dbInit'],
        'logs' => ['CService', 'logs'],
    ];
    
    public function start(): void {

        $requestUri = UServer::getValue('REQUEST_URI'); // Get the request URI from the server

        $route = trim($requestUri, '/'); // Get the second part of the URI and trim slashes
        ULogSys::toLog("Rotta:".$route);
        if(in_array($route, array_keys(self::$routes))) { // If the route exists, call the corresponding controller and method
            $controller = self::$routes[$route][0];
            $method = self::$routes[$route][1];
            ULogSys::toLog("Controller:".$controller . " # Method:".$method);
            if (class_exists($controller) && method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], []);
            } else {
                // If the controller or method does not exist, show a 404 error
                header('Location: https://digitalplot.altervista.org/error');
            }
        } else {
            // If the route does not exist, show a 404 error
            header('Location: https://digitalplot.altervista.org/error');
        }
    }
}