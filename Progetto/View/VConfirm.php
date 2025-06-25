<?php

class VConfirm {

    /**
     * Method to render the confirm page
     * This method will display the error page with the provided error message and user information.
     * @param string $confirmMessage The error message to display
     * @param int $plotPoints The number of plot points the user has (default is 0)
     * @param mixed $proPic The user's profile picture data (default is null)   
     * @param bool $privilege  Indicates if the user is a subscriber (default is false)
     * @param bool $isLogged Indicates if the user is logged in (default is false)
     * @return void
     * @throws Exception
     */
    public static function render($confirmMessage, $plotPoints = 0 , $proPic = null , int $privilege = BASIC, bool $isLogged = false): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> conferma.tpl");
        ULogSys::toLog("");
        $smarty->assign('confirmMessage', $confirmMessage);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('conferma.tpl');
    }

}