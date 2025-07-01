<?php

class VProfile
{

    /**
     * This method is used to render the user profile view.
     * It assigns the user data, plot points, profile picture, and login status to the Smarty template.
     * @param EUser $user 
     * @param int $plotPoints The number of plot points the user has.
     * @param mixed $proPic The encoded data for the user's profile picture.
     * @param bool $isLogged Indicates if the user is logged in.
     * @param int $privilege The privilege level of the user (default is BASIC).
     * @param array $articles The articles written by the user.
     * @param array $readdenArticles The articles read by the user.
     * @param array $reviews The reviews written by the user.
     * @return void
     */
    public static function render(EUser $user, int $plotPoints, mixed $proPic = null, bool $isLogged = false, int $privilege = BASIC, $articles, $readdenArticles, $reviews): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> profilo.tpl");
        $smarty->assign('user', $user);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('articles', $articles);
        $smarty->assign('readdenArticles', $readdenArticles);
        $smarty->assign('reviews', $reviews);
        $smarty->display('profilo.tpl');
    }

    /**
     * This method is used to render the user profile view.
     * It assigns the user data, plot points, profile picture, and login status to the Smarty template.
     * @param EUser $user 
     * @param int $plotPoints The number of plot points the user has.
     * @param mixed $proPic The encoded data for the user's profile picture.
     * @param bool $isLogged Indicates if the user is logged in.
     * @param int $privilege The privilege level of the user (default is BASIC).
     * @return void
     */
    public static function editProfile(EUser $user, int $plotPoints, mixed $proPic = null, bool $isLogged = false, int $privilege = BASIC): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> modificaProfilo.tpl");
        $smarty->assign('user', $user);
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->display('modificaProfilo.tpl');
    }
}
