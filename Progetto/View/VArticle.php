<?php

class VArticle{

    /**
     * Method to display an article.
     * This method uses Smarty to render the 'lettura.tpl' template with the provided article and writer information.
     * It assigns various user-related variables to the template for rendering.
     *
     * @param bool $isLogged Indicates if the user is logged in (default is false).
     * @param int $plotPoints The number of plot points the user has (default is 0).
     * @param mixed $proPic The user's profile picture data (default is null).
     * @param int $privilege The user's privilege level (default is BASIC).
     * @param EArticle $article The article to be displayed.
     * @param EUser $writer The writer of the article.
     * @return void
     */
    public static function showArticle(bool $isLogged = false, int $plotPoints = 0 , $proPic = null , int $privilege = BASIC, EArticle $article, EUser $writer): void {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> lettura.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('article', $article);
        $smarty->assign('writer', $writer);
        $smarty->display('lettura.tpl');
    }
}