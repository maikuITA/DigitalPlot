<?php

class CError
{

    /**
     * Method to handle 404 errors
     * this method checks if the user is logged in and retrieves their information to render an error page.
     * Depending on the type of error, it renders the appropriate error message.
     * The types are:
     * 404 - Not Found
     * 1 - Article not deleted correctly
     * 2 - Invalid format
     * 3 - Invalid file size
     * 4 - Empty article
     * 5 - Image not uploaded correctly
     * 6 - Article not approved correctly
     * 7 - Article not rejected correctly
     * 8 - Profile not modified correctly
     * If the user is not logged in, it renders a generic error message.
     * @param int $type Error type identifier
     * @return void
     */
    public static function error(int $type = 0): void
    {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($type === 404) {
                VError::render(errore: "404 Not Found", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 1) {
                VError::render(errore: "L'Articolo non è stato eliminato correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 2) {
                VError::render(errore: "Formato non valido", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 3) {
                VError::render(errore: "Dimensione del file non valida", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 4) {
                VError::render(errore: "Articolo vuoto", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 5) {
                VError::render(errore: "L'immagine non è stata caricata correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 6) {
                VError::render(errore: "L'articolo non è stato approvato correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 7) {
                VError::render(errore: "L'articolo non è stato scartato correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 8) {
                VError::render(errore: "Il profilo non è stato modificato correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } else {
                VError::render(errore: "Errore sconosciuto", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: 404);
            }
        } else {
            VError::render(errore: "Utente non loggato", plotPoints: 0, proPic: null, privilege: -1, isLogged: false, type: $type);
        }
    }
}
