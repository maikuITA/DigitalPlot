<?php

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
