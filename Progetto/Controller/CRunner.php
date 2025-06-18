<?php


use Utility\UServer; // Importa la classe UServer dallo spazio dei nomi Utility, per gestire le variabili del server.
use Utility\LogSys;
use Utility\Router; // Importa la classe Router dallo spazio dei nomi Utility, per gestire il routing delle richieste.
use View\VError; // Importa la classe VError dallo spazio dei nomi View, per visualizzare i messaggi di errore.
use Exception; // Importa la classe Exception nativa di PHP, per gestire le eccezioni.

class CRunner { // Definisce la classe CRunner, il controller principale dell'applicazione.

    private Router $router; // Dichiara una proprietà privata $router di tipo Router, per gestire il routing.

    public function __construct() { // Definisce il costruttore della classe CRunner.
        $this->router = new Router(); // Crea una nuova istanza della classe Router e la assegna alla proprietà $router.
        $this->router->defineRoutes(); // Chiama il metodo defineRoutes() dell'istanza di Router, per definire le rotte.
    }

    public function run() { // Definisce il metodo run(), il punto di ingresso principale del controller.
        try { // Inizia un blocco try per gestire le eccezioni.

            // Ottiene l'URI della richiesta, rimuovendo '/index.php' e usando '/' come predefinito.
            $requestUri = str_replace('/index.php', '', UServer::get('REQUEST_URI') ?? '/');

            // Ottiene il metodo HTTP della richiesta (GET, POST, ecc.), usando 'GET' come predefinito.
            $requestMethod = UServer::getRequestMethod() ?? 'GET';

            // Stampa l'URI della richiesta (a scopo di debug).echo "requestUri: " . $requestUri; 

            // Reindirizzamento homepage se l'URI è '/provasmarty' o vuoto.
            /* RIGHE DA CAPIRE BENE
                if ($requestUri === '/provasmarty' || empty($requestUri)) {
                    header("Location: /Progetto/home"); // Invia un header Location per reindirizzare l'utente.
                    exit; // Termina l'esecuzione dello script dopo il reindirizzamento.
                }
            */

            // Gestisce la richiesta tramite il router e ottiene la risposta.
            $response = $this->router->dispatch($requestMethod, $requestUri);

            // Gestisce la risposta e la invia al client.
            /*
                Codice per il var dump in error_log():
                error_log("response:");
                ob_start();
                var_dump($response);
                error_log(ob_get_clean());
                ATTUALE: NULL
            */
            $this->handleResponse($response);

        } catch (Exception $e) { // Cattura eventuali eccezioni lanciate nel blocco try.

            // Gestisce l'errore e visualizza un messaggio di errore 500 (Internal Server Error).
            $this->handleError(500, "Errore interno del server: " . $e->getMessage());
        }
    }

    // Gestisce la risposta generata dal controller.
    private function handleResponse(mixed $response): void {
        if (is_array($response)) { // Se la risposta è un array.
            header('Content-Type: application/json'); // Imposta l'header Content-Type su application/json.
            echo json_encode($response); // Converte l'array in una stringa JSON e la invia al client.
        } elseif (is_string($response)) { // Se la risposta è una stringa.
            echo $response; // Invia la stringa al client.
        } elseif ($response === null) { // Se la risposta è null.
            // Gestisce l'errore e visualizza un errore 404 (Not Found).
            // DEBUG ECCESSIVO: LogSys::toLog("\$response === null");
            // BASTA A PRINTARE HTML A CASO! $this->handleError(404, "Pagina non trovata.");
        }
    }

    // Gestisce gli errori e visualizza un messaggio di errore.
    private function handleError(int $errorCode, string $message): void {
        (new VError())->showMessage($errorCode, $message); // Crea un'istanza di VError e visualizza il messaggio di errore.
    }

    // Method to redirect to HTTPS if not already using it.
    public static function redirectToHttps(): void {
        if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off'){
            $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('Http/1.1 301 Moved Permanently'); 
            header('Location: ' . $location);
            exit;
        }
    }

}

?>