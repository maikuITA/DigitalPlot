<?php

/**
 * This class handles the display of followers and following for a user.
 * @param EUser $user The user object for whom followers and following are displayed.
 * @param bool $isLogged Indicates if the user is logged in.
 * @param int $plotPoints The plot points of the user.
 * @param string|null $proPic The profile picture of the user, if available.
 * @param int $privilege The privilege level of the user.
 * @param $followers The list of followers for the user.
 */
class VFollowers
{
    public static function showFollowers(EUser $user, bool $isLogged, int $plotPoints = 0, ?string $proPic = null, int $privilege = 0, $followers)
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> followers.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('user', $user);
        $smarty->assign('followers', $followers);
        $smarty->assign('following', $user->getFollowing());
        $smarty->display('followers.tpl');
    }
}
