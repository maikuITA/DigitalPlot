<?php

class VError {

    /**
     * Method to render the error page
     * This method will display the error page with the provided error message and user information.
     * @param string $errore The error message to display
     * @param int $plotPoints The number of plot points the user has (default is 0)
     * @param mixed $proPic The user's profile picture data (default is null)   
     * @param bool $privilege  Indicates if the user is a subscriber (default is false)
     * @param bool $isLogged Indicates if the user is logged in (default is false)
     * @return void
     * @throws Exception
     */
    public static function render(string $errore, $plotPoints = 0 , $proPic = null , int $privilege = BASIC, bool $isLogged = false, int $type): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> error.tpl");
        $smarty->assign('errore', $errore);
        $smarty->assign('type', $type);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('error.tpl');
    }
}