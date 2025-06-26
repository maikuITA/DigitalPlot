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
                VConfirm::render(confirmMessage: "L'articolo è stato eliminato correttamente!", plotPoints: $user->getPlotCard()->getPoints(), proPic:$user->getEncodedData(), privilege: $user->getPrivilege(), isLogged:true, type:$type);
            } elseif ($type === 2){
                VConfirm::render(confirmMessage:"Articolo salvato correttamente!", plotPoints:$user->getPlotCard()->getPoints(), proPic:$user->getEncodedData(), privilege:$user->getPrivilege(), isLogged: true,type: $type);
            } elseif ($type === 3){
                VConfirm::render(confirmMessage:"Commento rimosso con successo", plotPoints:$user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(),isLogged: true,type: $type);
            } elseif ($type === 4){
                VConfirm::render( confirmMessage:"Grazie ". $user->getUsername() . " per esserti abbonato!" ,plotPoints: $user->getPlotCard()->getPoints(), proPic:$user->getEncodedData(), privilege:$user->getPrivilege(), isLogged:true,type:$type);
            } elseif ($type === 5){
                VConfirm::render(confirmMessage: "Arrivederci!",plotPoints: 0, proPic: null ,isLogged:false, type: $type);
            }
        } else {
        VConfirm::render(confirmMessage: "Arrivederci!", plotPoints:0, proPic: null ,isLogged:false, type: $type);        
        }
    }
}