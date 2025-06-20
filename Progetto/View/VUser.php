<?php

class VUser{

    /**
     * Show the home page with the data received from the controller.
     * @param string|null $username The username of the logged-in user.
     * @param int|null $plotPoints The plot points of the user.
     * @param mixed $proPic The profile picture of the user, can be a string (URL) or a resource (image data).
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
     * Show the auth page
     * @throws Exception
     */
    public static function auth() {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> accesso.tpl");
        $smarty->display('accesso.tpl');
    }

    /**
     * Show the find page
     * @throws Exception
     */
    public static function find() {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> ricerca.tpl");
        $smarty->display('ricerca.tpl');
    }
}