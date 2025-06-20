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

}


?>