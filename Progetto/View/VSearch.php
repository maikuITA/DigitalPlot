<?php

class VSearch {

    /**
     * Method to display the search results
     * @param array $articles
     * @return void
     */
    public static function displaySearchResults(array $articles): void {
       $smarty = StartSmarty::configuration();
       ULogSys::toLog("Display -> ricerca.tpl");
       $smarty->assign('articles', $articles);
       $smarty->display('ricerca.tpl');
    }

    /**
     * @param bool $isLogged Indicates if the user is logged in.
     * This method is used to display the search page.
     * It uses Smarty to render the 'ricerca.tpl' template.
     * @throws Exception
     */
    public static function find($isLogged) {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> ricerca.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->display('ricerca.tpl');
    }
}


?>