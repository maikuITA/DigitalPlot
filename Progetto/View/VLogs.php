<?php


use Smarty\Exception;
class VLogs {

    public static function display() {
        $smarty = StartSmarty::configuration();
        LogSys::toLog("Display -> logs.tpl");
        $smarty->display('logs.tpl');
    }
}
