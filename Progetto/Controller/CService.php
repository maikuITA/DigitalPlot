<?php

class CService{

    /**
     * This function checks if any of the entities in the database are empty
     * It iterates through the provided array of data and checks the count of items in each entity.
     * If any entity has a count of zero, it returns 1, indicating that the database is empty.
     * If all entities have items, it returns 0.
     * @param array $allData
     * @return int
     */
    public static function printCounts(array $allData): int {
        foreach ($allData as $key => $items) {
            $count = count($items);
            if ($count === 0) {
                return 1;
            } 
        }
        return 0;
    }

    /**
     * This function initializes the database
     * It checks if the database is empty and installs it if necessary.
     * It retrieves all data from various entities and checks if any of them are empty.
     * If any entity is empty, it populates the database with initial data.
     * @return void
     */
    public static function dbInit(): void{
        // Check if the database is empty
        InstallerDb::install();
        $db = FPersistentManager::getInstance();
        $allData = [
            'articles' => $db->retrieveAll(EArticle::class),
            'cards' => $db->retrieveAll(ECreditCard::class),
            'follow' => $db->retrieveAll(EFollow::class),
            'plotcards' => $db->retrieveAll(EPlotCard::class),
            'purchases' => $db->retrieveAll(EPurchase::class),
            'readings' => $db->retrieveAll(EReading::class),
            'reviews' => $db->retrieveAll(EReview::class),
            'subscriptions' => $db->retrieveAll(ESubscription::class),
            'users' => $db->retrieveAll(EUser::class)
        ];
        $zero = self::printCounts($allData);
        if ($zero === 0){
            ULogSys::toLog("Database has been populated successfully.");
        } else {
            ULogSys::toLog("Waiting for the database to be populated...");
            BasicEntry::populateDb();
            ULogSys::toLog("Database has been populated successfully.");
        }
    }
    

    /**
     * This function displays the logs
     * It checks if the user is logged in and is an admin.
     * If so, it calls the VLogs view to render the logs.
     * If the user is not logged in or is not an admin, it redirects to the home page.
     * @return void
     */
    public static function logs(): void {
        if(CUser::isLogged() && CUser::isAdmin()){
            // chiama la view per la home page
            if(file_exists(__DIR__ . '/../View/VLogs.php')) {
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                VLogs::render(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege());
            } else {
                ULogSys::toLog("VLogs file not found", true);
            }
        }else{
            header('Location: https://digitalplot.altervista.org/home');
            exit;
        }
    }

    /**
     * This function clears the cache
     * It requires the clearcache.php file to perform the cache clearing operation.
     * After clearing the cache, it logs a message and redirects to the home page.
     * @return void
     */
    public static function clearCache(): void {
        require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Utility" . DIRECTORY_SEPARATOR . "clearcache.php";   
        ULogSys::toLog("Cache pulita correttamente.");
        header('Location: https://digitalplot.altervista.org/home'); 
    }

}