<?php

class CAbbonati {
    
    public static function subscribe(): void {
        // chiama la view per la home page
        if(file_exists(__DIR__ . '/../View/VAbbonati.php')) {
            VAbbonati::render();
        } else {
            ULogSys::toLog("VHome file not found", true);
        }
    }

}