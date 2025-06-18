<?php


use Start\StartSmarty;
use Smarty\Exception;
use Smarty\Smarty;

class VError {
    private Smarty $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Mostra un messaggio di errore personalizzato usando Smarty.
     *
     * @param int $statusCode Codice di stato HTTP (es. 404, 500).
     * @param string|null $message Messaggio di errore da visualizzare. Se nullo, verrà mostrato un messaggio predefinito.
     * @throws Exception|\Exception
     */
    public function showError(int $statusCode, ?string $message = null): void {
        http_response_code($statusCode);
        $defaultMessages = [
            400 => 'Richiesta non valida.',
            401 => 'Accesso non autorizzato.',
            403 => 'Accesso negato.',
            404 => 'Pagina non trovata.',
            500 => 'Errore interno del server.',
        ];

        $errorMessage = $message ?? ($defaultMessages[$statusCode] ?? 'Si è verificato un errore imprevisto.');
        $this->smarty->assign('status', $statusCode);
        $this->smarty->assign('errorMessage', $errorMessage);

        try {
            $this->smarty->display('error.tpl');
        } catch (Exception $e) {
            echo "<h1>Errore {$statusCode}</h1><p>{$errorMessage}</p>";
        }
    }

    /**
     * Mostra un messaggio informativo (non di errore) usando Smarty.
     *
     * @param string $message Messaggio da visualizzare
     * @throws Exception|\Exception
     */
    public function showMessage(string $message): void
    {
        $this->smarty->assign('message', $message);

        try {
            $this->smarty->display('message.tpl');
        } catch (Exception $e) {
            echo "<h1>Messaggio</h1><p>{$message}</p>";
        }
    }
}
