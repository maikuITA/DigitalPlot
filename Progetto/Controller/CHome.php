<?php

class CHome {
    
    public static function home(): void {
        // chiama la view per la home page
        $view = new VHome();
        $view->display();
    }

}