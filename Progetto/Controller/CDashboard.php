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
                $articoliDaRevisionare = FPersistentManager::getInstance()->retrievePendingArticles();
                $articoliPubblicati = FPersistentManager::getInstance()->searchArticles('%', '%', '%', '0001-01-01');
                $commenti = FPersistentManager::getInstance()->retrieveAllReview();
                VDashboard::render(privilege: $user->getPrilvlege() ,plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), isLogged:true, articoliDaRevisionare: $articoliDaRevisionare, articoliPubblicati: $articoliPubblicati, commenti: $commenti);
        }else {
            header('Location: https://digitalplot.altervista.org/home');
            exit;
        }
    }

    /**
     * Retrives all the information for the dashboard
     */
    public static function dashboardUpdate(): void{
        header('Content-Type: application/json');
        if(CUser::isLogged() && CUser::isAdmin()){
            $numArtiG = FPersistentManager::getInstance()->retrieveNumOnDate(EArticle::class, 'releaseDate', date('Y-m-d', strtotime('-1 day')));
            $numArtiS = FPersistentManager::getInstance()->retrieveNumOnDate(EArticle::class, 'releaseDate', date('Y-m-d', strtotime('-1 week')));
            $numArtiM = FPersistentManager::getInstance()->retrieveNumOnDate(EArticle::class, 'releaseDate', date('Y-m-d', strtotime('-1 month')));
            $numArtiT = FPersistentManager::getInstance()->countRecord(EArticle::class);
            $numPurG = FPersistentManager::getInstance()->retrieveNumOnDate(EPurchase::class, 'purchaseDate', date('Y-m-d', strtotime('-1 day')));
            $numPurS = FPersistentManager::getInstance()->retrieveNumOnDate(EPurchase::class, 'purchaseDate', date('Y-m-d', strtotime('-1 week')));
            $numPurM = FPersistentManager::getInstance()->retrieveNumOnDate(EPurchase::class, 'purchaseDate', date('Y-m-d', strtotime('-1 month')));
            $numPurT = FPersistentManager::getInstance()->countRecord(EPurchase::class);
            $numUserT = FPersistentManager::getInstance()->countRecord(EUser::class);
            $abbAttivi = FPersistentManager::getInstance()->countActiveSubsriber(EUser::class);
            echo json_encode([
                'lastGA' => $numArtiG,
                'lastSA' => $numArtiS,
                'lastMA' => $numArtiM,
                'totalA' => $numArtiT,
                'lastGP' => $numPurG,
                'lastSP' => $numPurS,
                'lastMP' => $numPurM,
                'totalP' => $numPurT,
                'totalU' => $numUserT,
                'abbAttivi' => $abbAttivi
            ]);
            exit;
        }else{
            echo json_encode([
                'lastGA' => -1,
                'lastSA' => -1,
                'lastMA' => -1,
                'totalA' => -1,
                'lastGP' => -1,
                'lastSP' => -1,
                'lastMP' => -1,
                'totalP' => -1,
                'totalU' => -1
            ]);
            exit;
        }
    }
}