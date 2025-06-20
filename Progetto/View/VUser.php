<?php

class VUser{

    /**
     * This method is used to display the home page.
     * It uses Smarty to render the 'home.tpl' template.
     * @param string|null $username The username of the logged-in user.
     * @param int|null $plotPoints The plot points of the user.
     * @param mixed $proPic The profile picture of the user.
     * @param array|null $articles The articles to be displayed on the home page.
     * @param bool $logged Indicates if the user is logged in.
     * @throws Exception
     */
    public static function home(?string $username = null, ?int $plotPoints = null, $proPic = null, ?array $articles = null, bool $logged = false){
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> home.tpl");
        $smarty->assign('isLogged', $logged);
        $smarty->assign('username', $username);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('articles', $articles);
        $smarty->display('home.tpl');
    }

    /**
     * This method is used to display the access page.
     * It uses Smarty to render the 'accesso.tpl' template.
     * @throws Exception
     */
    public static function auth() {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> accesso.tpl");
        $smarty->display('accesso.tpl');
    }


}