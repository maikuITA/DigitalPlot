<?php

class CFrontController {

    private static $routes = [
        'home' => ['CHome', 'home'],
        'error404' => ['CError', 'error404'],
        'accesso' => ['CAccesso', 'accesso'],
    ];
    
    /**
     * Method to run the front controller
     * This method will parse the request URI, determine the controller and method to call,
     * and then call the appropriate method with any parameters.
     * @param string $requestUri The request URI to process, typically obtained from the server's request.
     * @return void
     */
    public function start(): void {

        // Get the request URI from the server
        $requestUri = UServer::getValue('REQUEST_URI');

        $route = trim($requestUri, '/'); // Get the second part of the URI and trim slashes

        if(in_array($route, array_keys(self::$routes))) {
            // If the route exists, call the corresponding controller and method
            $controller = self::$routes[$route][0];
            $method = self::$routes[$route][1];

            if (class_exists($controller) && method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], []);
            } else {
                // If the controller or method does not exist, show a 404 error
                CError::error404();
            }
        } else {
            // If the route does not exist, show a 404 error
            CError::error404();
        }
    }
}