<?php

class CHome {
    
    public static function home(): void {
        // chiama la view per la home page
        if(file_exists(__DIR__ . '/../View/VHome.php')) {
            VHome::render();
        } else {
            ULogSys::toLog("VHome file not found", true);
        }
    }

}