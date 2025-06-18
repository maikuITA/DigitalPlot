<?php


use Exception;
use Utility\LogSys;

class Router {
    private array $routes = [];

    /**
     * Aggiunge una nuova rotta al router
     */
    public function addRoute(string $method, string $path, string $controller, string $action): void {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * Risolve la richiesta confrontandola con le rotte registrate
     */
    public function resolve(string $requestMethod, string $requestUri): ?array {

        LogSys::toLog("");
        LogSys::toLog("Ip degl client -> " . UServer::getClientIP());
        LogSys::toLog("Risolvo la rotta -> Method=$requestMethod, URI=$requestUri");

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
                LogSys::toLog("Rotta trovata! " . json_encode($route));
                return [
                    'controller' => $route['controller'],
                    'action' => $route['action'],
                    'params' => $params
                ];
            }
        }

        LogSys::toLog("Rotta non trovata -> Method=$requestMethod, URI=$requestUri");
        foreach ($this->routes as $r) {
            // Debug -> LogSys::toLog("Defined route: " . json_encode($r));
        }
        return null;
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

            LogSys::toLog("Caricamento del controller -> {$controllerName}");
            //error_log("action: "); error_log($action);
            //error_log("params: "); error_log(print_r($params));

            // Controllo se il file del controller esiste
            if (!file_exists(__DIR__ . "/../Controller/{$controllerName}.php")) {
                LogSys::toLog("ERRORE: Il file {$controllerName}.php NON ESISTE!");
            }
            require_once __DIR__ . "/../Controller/{$controllerName}.php";
            $controllerClass = "Controller\\$controllerName";
            if (!class_exists($controllerClass)) {
                throw new Exception("Controller  -> $controllerClass not found.");
            }
            $controller = new $controllerClass();
            
            return call_user_func_array([$controller, $action], $params);
        }
        LogSys::toLog("Rotta non trovata -> " . $requestUri);
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

    /**
     * Definizione delle rotte
     */
    public function defineRoutes(): void {
        // Percorso del file JSON
        // Per capire il percorso corrente: echo getcwd();
        $file_path = 'Progetto/Utility/json/routes.json';

        // Leggi il contenuto del file JSON
        $json_content = file_get_contents($file_path);

        // Verifica se la lettura del file ha avuto successo
        if ($json_content === false) {
            die('Errore nella lettura del file JSON.');
        }

        // Decodifica il contenuto JSON in un array associativo
        $rotte = json_decode($json_content, true);

        // Verifica se la decodifica JSON ha avuto successo
        if ($rotte === null && json_last_error() !== JSON_ERROR_NONE) {
            die('Errore nella decodifica JSON: ' . json_last_error_msg());
        }

        // Analizzo e creo le rotte
        // DEBUG LogSys::toLog("");
        // DEBUG LogSys::toLog("[!] DEBUG ROTTE");
        foreach ($rotte as $rotta => $parametri) {
            if (is_array($parametri)) {
                // Se il valore è un array, itera attraverso di esso e recupero i parametri della rotta
                // DEBUG LogSys::toLog($parametri["metodo"] . $parametri["uri"] . $parametri["controller"] . $parametri["action"]);
                $this->addRoute($parametri["metodo"], $parametri["uri"], $parametri["controller"], $parametri["action"]); // Root
            }
        }
        // DEBUG LogSys::toLog("");
    }
}
