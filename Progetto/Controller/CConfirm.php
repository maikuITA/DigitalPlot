<?php

use Doctrine\DBAL\Types\Type;

class CConfirm
{

    /**
     * Method to handle confirmation
     * This method checks if the user is logged in and retrieves the user data.
     * Depending on the type of confirmation, it renders the appropriate confirmation message.
     * The types are:
     * 1 - Article deleted
     * 2 - Article saved
     * 3 - Comment removed
     * 4 - User subscribed
     * 5 - User logged out
     * 6 - Article approved
     * 7 - Article rejected
     * 8 - Profile modified
     * If the user is not logged in, it renders a generic confirmation message.
     * @return void
     */
    public static function confirm(int $type = 0): void
    {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($type === 1) {
                VConfirm::render(confirmMessage: "L'articolo è stato eliminato correttamente!", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 2) {
                VConfirm::render(confirmMessage: "Articolo salvato correttamente!", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 3) {
                VConfirm::render(confirmMessage: "Commento rimosso con successo", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 4) {
                VConfirm::render(confirmMessage: "Grazie " . $user->getUsername() . " per esserti abbonato!", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 5) {
                VConfirm::render(confirmMessage: "Arrivederci!", plotPoints: 0, proPic: null, privilege: 0, isLogged: false, type: $type);
            } elseif ($type === 6) {
                VConfirm::render(confirmMessage: "L'articolo è stato approvato!", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 7) {
                VConfirm::render(confirmMessage: "L'articolo è stato scartato!", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } elseif ($type === 8) {
                VConfirm::render(confirmMessage: "Il profilo è stato modificato con successo!", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: $type);
            } else {
                VConfirm::render(confirmMessage: "Operazione completata con successo!", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), isLogged: true, type: 4);
            }
        } else {
            VConfirm::render(confirmMessage: "Arrivederci!", plotPoints: 0, proPic: null, privilege: BASIC, isLogged: false, type: $type);
        }
    }
}
