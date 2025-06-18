<?php


use Start\StartSmarty;
use Smarty\Exception;
use Utility\LogSys;

class VLogs {

    public static function display() {
        $smarty = StartSmarty::configuration();
        LogSys::toLog("Display -> logs.tpl");
        $smarty->display('logs.tpl');
    }
}
