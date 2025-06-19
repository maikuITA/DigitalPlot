<?php

class CSubscribe {
    
    public static function subscribe(): void {
        // chiama la view per la home page
        if(file_exists(__DIR__ . '/../View/VSubscribe.php')) {
            VSubscribe::render();
        } else {
            ULogSys::toLog("VSubscribe file not found", true);
        }
    }

}