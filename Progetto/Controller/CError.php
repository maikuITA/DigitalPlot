<?php

class CError {
    
    /**
     * Method to handle 404 errors
     * This method will redirect the user to a custom 404 error page.
     * @return void
     */
    public static function error(int $type = 0): void {
        if(CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($type === 404){
                VError::render(errore: "404 Not Found", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 1){
                VError::render(errore: "L'Articolo non è stato eliminato correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 2){
                VError::render(errore: "Formato non valido", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 3){
                VError::render(errore: "Dimensione del file non valida", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 4){
                VError::render(errore: "Articolo vuoto", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 5){
                VError::render(errore: "L'immagine non è stata caricata correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            }
        } else {
            VError::render(errore: "Utente non loggato", isLogged: false, type: $type);
        }
    }

    /**
     * Method to handle 404 errors
     * This method will redirect the user to a custom 404 error page.
     * @return void
     */
    public static function confirm(int $type = 0): void {
        if(CUser::isLogged()) {
            VConfirm::render("Conferma");
        } else {
            VError::render(errore: "Utente non loggato", isLogged: false, type: $type);
        }
    }
    
}