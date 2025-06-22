<?php

class CDashboard{
    /**
     * Display the dashboard for the admin user.
     * This function checks if the user is logged in and is an admin.
     * @return void
     */
    public static function dashboard(): void{
        if(CUser::isLogged() && CUser::isAdmin()){
            // chiama la view per la home page
            if(file_exists(__DIR__ . '/../View/VDashboard.php')) {
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                VDashboard::render(plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData());
            } else {
                ULogSys::toLog("VDashboard file not found", true);
            }
        }else{
            header('Location: https://digitalplot.altervista.org/home');
            exit;
        }
    }
}