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
     */
    private function defineRoutes(): void {
        // Percorso del file JSON
        $file_path = __DIR__ . DIRECTORY_SEPARATOR .'json' . DIRECTORY_SEPARATOR . ' routes.json';

        // Leggi il contenuto del file JSON
        $json_content = file_get_contents($file_path);

        // Verifica se la lettura del file ha avuto successo, non può essere false poiché il file esiste e lo scriviamo noi
        if ($json_content === false) {
            ULogSys::toLog("Errore nella lettura del file JSON: " . $file_path, true);
            die('Errore nella lettura del file JSON.'); // Termina l'esecuzione dello script se il file non può essere letto
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
     * Aggiunge una nuova rotta al router
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
     * Gestisce la richiesta e la passa al Front Controller
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
            if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . "{$controllerName}.php")) {
                ULogSys::toLog("ERRORE: Il file {$controllerName}.php NON ESISTE!");
            }
            require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . "{$controllerName}.php";
            $controllerClass = "Controller\\$controllerName";
            if (!class_exists($controllerClass)) {
                throw new Exception("Controller  -> $controllerClass not found.");
            }
            $controller = new $controllerClass();
            
            return call_user_func_array([$controller, $action], $params);
        }
        ULogSys::toLog("Rotta non trovata -> " . $requestUri);
        return null;
    }

    /**
     * Risolve la richiesta confrontandola con le rotte registrate
     */
    public function resolve(string $requestMethod, string $requestUri): ?array {

        ULogSys::toLog("");
        ULogSys::toLog("Ip degl client -> " . UServer::getClientIP());
        ULogSys::toLog("Risolvo la rotta -> Method=$requestMethod, URI=$requestUri");

        // Rimuove i parametri GET dalla richiesta (se presenti)
        $parsedUrl = parse_url($requestUri);
        $cleanUri = $parsedUrl['path'];

        // Rimuove eventuali caratteri di escape come `\/`
        $cleanUri = str_replace('\\', '', $cleanUri);

        // Log per conferma error_log("Cleaned URI: $cleanUri");  

        foreach ($this->routes as $route) {
            error_log("Controllo la rotta -> " . json_encode($route));

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
        foreach ($this->routes as $r) {
            // Debug -> ULogSys::toLog("Defined route: " . json_encode($r));
        }
        return null;
    }

    

    /**
     * Confronta l'URI richiesto con il percorso della rotta definita
     */
    private function match(string $routePath, string $requestUri, array &$params): bool {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)}/', '(?P<$1>[^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $requestUri, $matches)) {
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return true;
        }

        return false;
    }

    
}
