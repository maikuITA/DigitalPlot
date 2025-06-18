<?php


use Exception;

class URouter {
    private array $routes = [];

    public function __construct() {
        // Inizializza le rotte
        $this->defineRoutes();
    }

    /**
     * Defines the routes from a JSON file
     * @return void
     */
    private function defineRoutes(): void {
        // Percorso del file JSON
        $file_path = __DIR__ . DIRECTORY_SEPARATOR .'json' . DIRECTORY_SEPARATOR . ' routes.json';

        // Leggi il contenuto del file JSON
        $json_content = file_get_contents($file_path);

        // Verifica se la lettura del file ha avuto successo, non può essere false poiché il file esiste e lo scriviamo noi
        if ($json_content === false) {
            ULogSys::toLog("Errore nella lettura del file JSON: " . $file_path, true);
            die('Errore nella lettura del file JSON.'); 
            // Termina l'esecuzione dello script se il file non può essere letto
            // Mostra un messaggio di errore sul browser
        }

        // Decodifica il contenuto JSON in un array associativo (grazie a true che definisce il tipo)
        // Se ci sono errori vengono catturati da json_last_error()
        $rotte = json_decode($json_content, true);

        // Verifica se la decodifica JSON ha avuto successo
        if ($rotte === null && json_last_error() !== JSON_ERROR_NONE) {
            ULogSys::toLog("Errore nella decodifica del file JSON: " . json_last_error_msg(), true);
            die('Errore nella decodifica JSON: ' . json_last_error_msg());
        }

        // Analizzo e creo le rotte
        foreach ($rotte as $rotta => $parametri) {
            if (is_array($parametri)) {
                // Se il valore è un array, itera attraverso di esso e recupero i parametri della rotta
                $this->addRoute($parametri["metodo"], $parametri["uri"], $parametri["controller"], $parametri["action"]); // Root
            } else {
                ULogSys::toLog("Errore: la rotta '$rotta' non è un array.", true);
            }
        }
    }


    /**
     * Add new route to the router
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $path Path of the route
     * @param string $controller Controller class name
     * @param string $action Action method name in the controller
     * @return void
     */
    private function addRoute(string $method, string $path, string $controller, string $action): void {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * Handle the request and dispatch it to the appropriate controller and action
     * @param string $requestMethod HTTP method of the request (GET, POST, etc.)
     * @param string $requestUri URI of the request
     * @return array|null Returns an array with the controller, action, and parameters if the route is found, or null if not found.
     * @throws Exception
     */
    public function dispatch(string $requestMethod, string $requestUri): ?array {
        $route = $this->resolve($requestMethod, $requestUri);

        if ($route) {
            $controllerName = $route['controller'];
            $action = $route['action'];
            $params = $route['params'];

            ULogSys::toLog("Caricamento del controller -> {$controllerName}");
           
            // Controllo se il file del controller esiste
            if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . "$controllerName.php")) {
                ULogSys::toLog("ERRORE: Il file $controllerName.php NON ESISTE!", true);
            }
            // verifico l'esistenza dell classe controller cercata
            if (!class_exists($controllerName)) {
                throw new Exception("Controller  -> $controllerName not found.");
            }
            $controller = new $controllerName();
            // Lancio il metodo dell'azione del controller se esiste tramite il metodo call_user_func_array tramite la callback tra []
            if (!method_exists($controller, $action)) {
                throw new Exception("Action -> $action not found in controller -> $controllerName.");
                ULogSys::toLog("ERRORE: Il metodo $action non esiste nel controller $controllerName!", true);
            }
            return call_user_func_array([$controller, $action], $params);
        }
        ULogSys::toLog("Rotta non trovata -> " . $requestUri);
        return null;
    }

    /**
     * Resolves the route based on the request method and URI
     * @param string $requestMethod HTTP method of the request (GET, POST, etc.)
     * @param string $requestUri URI of the request
     * @return array|null Returns an array with the controller, action, and parameters if the route is found, or null if not found.
     */
    public function resolve(string $requestMethod, string $requestUri): ?array {

        ULogSys::toLog(""); //in questo modo si crea una riga vuota nel log
        ULogSys::toLog("Ip degl client -> " . UServer::getClientIP());
        ULogSys::toLog("Risolvo la rotta -> Method=$requestMethod, URI=$requestUri");

        // Rimuove i parametri GET dalla richiesta (se presenti)
        $parsedUrl = parse_url($requestUri);
        $cleanUri = $parsedUrl['path'];

        // Rimuove eventuali caratteri di escape come `\/`
        $cleanUri = str_replace('\\', '', $cleanUri);

        foreach ($this->routes as $route) {
            
            $params = []; // Inizializza $params come array vuoto
            if ($this->match($route['path'], $cleanUri, $params) && $route['method'] === strtoupper($requestMethod)){
                ULogSys::toLog("Rotta trovata! " . json_encode($route));
                return [
                    'controller' => $route['controller'],
                    'action' => $route['action'],
                    'params' => $params
                ];
            }
        }

        ULogSys::toLog("Rotta non trovata -> Method=$requestMethod, URI=$requestUri");
        ULogSys::toLog("Rotta non trovata -> Method=$requestMethod, URI=$requestUri", true);
        return null;
    }



    /**
     * Matches the route path (es. "/users/{id}") with the request URI (es. /users/123) and 
     * update $params with the extracts parameters (es. id = 123) (thanks to &)
     * @param string $routePath The path of the route (e.g., '/users/{id}')
     * @param string $requestUri The URI of the request (e.g., '/users/123')
     * @param array $params Reference to an array where the extracted parameters will be stored
     * @return bool Returns true if the route matches, false otherwise
     */
    private function match(string $routePath, string $requestUri, array &$params): bool {
        /** 
         * Sostituisce ogni parametro nel {} con una regular expression
         * lo / tutto a sinistra e alla fine del primo parametro rappresentano i delemitatori della regex
         * \{ significa cerca le stringhe che matchano con il patter tra {}; \ (carattere di escape) 
         * Esempio: '/users/{id}' diventa '/users/(?P<id>[^/]+)', ovvero un named capture group
         * ?P< nome che viene dato alle chiavi dinamiche (es. id), a scelta >pattern 
         * [^/]+, rappresenta il pattern e significa che il parametro può essere qualsiasi cosa tranne lo slash (/) e deve essere almeno un carattere
        */
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)}/', '(?P<$1>[^/]+)', $routePath); // il routh path modificato dai replaces
        // gli #^ (^ significa inizio stringa) e $# servono a fare in modo che la regex venga confrntata interamente con l'URI della richiesta
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $requestUri, $matches)) {
            // filtra l'array $matches e lascia solo le chiavi (ARRAY_FILTER_USE_KEY, contenuto di P<..>) che sono stringhe
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return true;
        }
        return false;
    }

    
}
