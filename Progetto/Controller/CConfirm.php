<?php

use Doctrine\DBAL\Types\Type;

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
                VConfirm::render("L'articolo è stato eliminato correttamente!",  $user->getPlotCard()->getPoints(), $user->getEncodedData(),  $user->getPrivilege(),true,$type);
            } elseif ($type === 2){
                VConfirm::render("Articolo salvato correttamente!", $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), true, $type);
            } elseif ($type === 3){
                VConfirm::render("Commento rimosso con successo", $user->getPlotCard()->getPoints(),  $user->getEncodedData(), $user->getPrivilege(), true, $type);
            } elseif ($type === 4){
                VConfirm::render( "Grazie ". $user->getUsername() . " per esserti abbonato!" , $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), true, $type);
            } elseif ($type === 5){
            VConfirm::render(confirmMessage: "Arrivederci " . $user->getUsername() . "!", isLogged:false, type: $type);
            }
        } else {
            VConfirm::render(confirmMessage: "Conferma!", isLogged: false, type: $type);
        }
    }
}