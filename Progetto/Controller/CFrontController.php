<?php

class CFrontController{
    
    /**
     * Method to run the front controller
     * This method will parse the request URI, determine the controller and method to call,
     * and then call the appropriate method with any parameters.
     * @param string $requestUri The request URI to process, typically obtained from the server's request.
     * @return void
     */
    public function run(): void {
        $requestUri = UServer::getValue('REQUEST_URI');

        $requestUri = trim($requestUri, '/');
        $uriParts = explode('/', $requestUri);

        // Remove DigitalPlot from the URI parts
        array_shift($uriParts);

        // Extract controller and method names
        $controllerName = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'User';
        $methodName = !empty($uriParts[1]) ? $uriParts[1] : 'login';

        // Load the controller class
        $controllerClass = 'C' . $controllerName;
        $controllerFile = __DIR__ . "/{$controllerClass}.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            // Check if the method exists in the controller
            if (method_exists($controllerClass, $methodName)) {
                // Call the method
                $params = array_slice($uriParts, 2); // Get optional parameters
                call_user_func_array([$controllerClass, $methodName], $params);
            } else {
                // Method not found, handle appropriately (e.g., show 404 page)
                header('Location: /DigitalPlot/User/home');
            }
        } else {
            // Controller not found, handle appropriately (e.g., show 404 page)
            header('Location: /DigitalPlot/Error/error404');
        }
    }

    /**
     * Method to redirect to HTTPS if not already using it
     * @return void
     */
    public static function redirectToHttps(): void {
        $protocol = UServer::getValue('HTTPS');
        $request_URI = UServer::getValue('REQUEST_URI');
        if (empty($protocol) || $protocol === 'off'){
            $location = 'https://' . $protocol . $request_URI;
            header('HTTP/1.1 301 Moved Permanently'); 
            header('Location: ' . $location);
            exit;
        }
    }
}