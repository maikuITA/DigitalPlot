<?php

class CConfirm{

    /**
     * Method to handle confirmation
     * This method will redirect the user to a custom 404 error page.
     * @return void
     */
    public static function confirm(int $type = 0): void {
        if(CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($type === 1){
                VConfirm::render(confirmMessage: "L'Articolo non è stato eliminato correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 2){
                VConfirm::render(confirmMessage: "Formato non valido", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 3){
                VConfirm::render(confirmMessage: "Dimensione del file non valida", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 4){
                VConfirm::render(confirmMessage: "Articolo vuoto", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            } elseif ($type === 5){
                VConfirm::render(confirmMessage: "L'immagine non è stata caricata correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege() , isLogged: true, type: $type);
            }
        } else {
            VConfirm::render(confirmMessage: "Utente non loggato", isLogged: false, type: $type);
        }
    }
}