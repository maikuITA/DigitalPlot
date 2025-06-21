<?php

class VError {

    /**
     * Method to render the error page
     * This method will display the error page with the provided error message and user information.
     * @param string $errore The error message to display
     * @param int $plotPoints The number of plot points the user has (default is 0)
     * @param mixed $proPic The user's profile picture data (default is null)   
     * @param bool $isAbbonato Indicates if the user is a subscriber (default is false)
     * @param bool $isLogged Indicates if the user is logged in (default is false)
     * @return void
     * @throws Exception
     */
    public static function render(string $errore, $plotPoints = 0 , $proPic = null , bool $isAbbonato = false, bool $isLogged = false): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> error.tpl");
        $smarty->assign('errore', $errore);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('error.tpl');
    }
}