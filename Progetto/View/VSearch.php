<?php

class VSearch {

    /**
     * Method to display the search results
     * @param array $articles
     * @return void
     */
    public static function displaySearchResults(?array $articles,bool $isLogged = false, $plotPoints = 0 , $proPic = null, int $isAbbonato = BASIC): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> ricerca.tpl");
        $smarty->assign('articles', $articles);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('ricerca.tpl');
    }

    /**
     * @param bool $isLogged Indicates if the user is logged in.
     * This method is used to display the search page.
     * It uses Smarty to render the 'ricerca.tpl' template.
     * @throws Exception
     */
    public static function find(bool $isLogged = false, $plotPoints = 0 , $proPic = null, int $isAbbonato = BASIC) {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> ricerca.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('isAbbonato', $isAbbonato);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('ricerca.tpl');
    }
}


?>