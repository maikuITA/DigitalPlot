<?php

class CDashboard{
    /**
     * Display the dashboard for the admin user.
     * This function checks if the user is logged in and is an admin.
     * @return void
     */
    public static function dashboard(): void{
        if(CUser::isLogged() && CUser::isAdmin()){
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                VDashboard::render(plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData());
        }else {
            header('Location: https://digitalplot.altervista.org/home');
            exit;
        }
    }
}