<?php

class CAccesso {
    
    public static function accesso(): void {
        // chiama la view per la home page
        if(file_exists(__DIR__ . '/../View/VAccesso.php')) {
            VAccesso::render();
        } else {
            ULogSys::toLog("VAccesso file not found", true);
        }
    }

}