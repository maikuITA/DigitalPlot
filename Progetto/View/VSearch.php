<?php

class VSearch {

    /**
     * Method to display search results.
     * This method uses Smarty to render the 'ricerca.tpl' template with the provided articles,
     * user login status, plot points, profile picture, and privilege level.    
     * @param mixed $articles
     * @param bool $isLogged Indicates if the user is logged in.
     * @param int $plotPoints The number of plot points the user has.
     * @param mixed $proPic The user's profile picture data.
     * @param int $privilege The user's privilege level (default is BASIC).
     * @return void
     */
    public static function displaySearchResults( $articles,bool $isLogged = false, $plotPoints = 0 , $proPic = null, int $privilege = BASIC): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> ricerca.tpl");
        $smarty->assign('articles', $articles);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('ricerca.tpl');
    }

    /**
     * @param bool $isLogged Indicates if the user is logged in.
     * @param int $plotPoints The number of plot points the user has.
     * @param mixed $proPic The user's profile picture data.
     * @param int $privilege The user's privilege level (default is BASIC).
     * @return void
     * @throws Exception
     */
    public static function find(bool $isLogged = false, $plotPoints = 0 , $proPic = null, int $privilege = BASIC) {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> ricerca.tpl");
        ULogSys::toLog("");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('ricerca.tpl');
    }
}


?>