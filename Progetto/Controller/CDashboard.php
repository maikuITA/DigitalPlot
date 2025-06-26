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

    /**
     * Retrives all the information for the dashboard
     */
    public static function dashboardUpdate(): void{
        if(CUser::isLogged() && CUser::isAdmin()){
            $numArtiG = FPersistentManager::getInstance()->retrieveNumOnDate(EArticle::class, 'releaseDate', date('Y-m-d', strtotime('-1 day')));
            $numArtiS = FPersistentManager::getInstance()->retrieveNumOnDate(EArticle::class, 'releaseDate', date('Y-m-d', strtotime('-1 week')));
            $numArtiM = FPersistentManager::getInstance()->retrieveNumOnDate(EArticle::class, 'releaseDate', date('Y-m-d', strtotime('-1 month')));
            $numArtiT = FPersistentManager::getInstance()->countRecord(EArticle::class);
            $numPurG = FPersistentManager::getInstance()->retrieveNumOnDate(EPurchase::class, 'purchaseDate', date('Y-m-d', strtotime('-1 day')));
            $numPurS = FPersistentManager::getInstance()->retrieveNumOnDate(EPurchase::class, 'purchaseDate', date('Y-m-d', strtotime('-1 week')));
            $numPurM = FPersistentManager::getInstance()->retrieveNumOnDate(EPurchase::class, 'purchaseDate', date('Y-m-d', strtotime('-1 month')));
            $numPurT = FPersistentManager::getInstance()->countRecord(EPurchase::class);
        }else{
            exit;
        }
    }
}