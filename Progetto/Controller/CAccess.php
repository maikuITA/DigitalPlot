<?php

class CAccess {
    
    public static function access(): void {
        // chiama la view per la home page
        if(file_exists(__DIR__ . '/../View/VAccess.php')) {
            VAccess::render();
        } else {
            ULogSys::toLog("VAccess file not found", true);
        }
    }

}