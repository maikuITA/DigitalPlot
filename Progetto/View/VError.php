<?php

class VError
{

    /**
     * Method to render the error page
     * This method will display the error page with the provided error message and user information.
     * @param string $errore The error message to display
     * @param int $plotPoints The number of plot points the user has (default is 0)
     * @param mixed $proPic The user's profile picture data (default is null)   
     * @param int $privilege  Indicates if the user is a subscriber (default is false)
     * @param bool $isLogged Indicates if the user is logged in (default is false)
     * @param int $type The type of error (e.g., 0 for error, 1 for success)
     * @return void
     */
    public static function render(string $errore, int $plotPoints = 0, mixed $proPic = null, int $privilege = BASIC, bool $isLogged = false, int $type): void
    {
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
