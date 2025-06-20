<?php

class CService{

    /**
     *  This function prints the counts of items in each category
     *  @param array $allData
     *  @return int
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
     * run this function in order to populate the db
     * @return void
     */
    public static function dbInit(): void{
        // Check if the database is empty
        InstallerDb::install();
        $db = FPersistentManager::getInstance();
        $allData = [
            'articles' => $db->retriveAll(EArticle::class),
            'cards' => $db->retriveAll(ECreditCard::class),
            'discounts' => $db->retriveAll(EDiscount::class),
            'follow' => $db->retriveAll(EFollow::class),
            'plotcards' => $db->retriveAll(EPlotCard::class),
            'purchases' => $db->retriveAll(EPurchase::class),
            'readers' => $db->retriveAll(EReader::class),
            'readings' => $db->retriveAll(EReading::class),
            'reviews' => $db->retriveAll(EReview::class),
            'subscribers' => $db->retriveAll(ESubscriber::class),
            'subscriptions' => $db->retriveAll(ESubscription::class),
            'users' => $db->retriveAll(EUser::class),
            'writers' => $db->retriveAll(EWriter::class),
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
     * This function renders the logs page view
     * @return void
     */
    public static function logs(): void {
        // chiama la view per la home page
        if(file_exists(__DIR__ . '/../View/VLogs.php')) {
            VLogs::render();
        } else {
            ULogSys::toLog("VLogs file not found", true);
        }
    }

    /**
     * This function clears the cache
     * @return void
     */
    public static function clearCache(): void {
        require_once __DIR__ . ".." . DIRECTORY_SEPARATOR . "Utility" . DIRECTORY_SEPARATOR . "clearcache.php";   
        ULogSys::toLog("Cache pulita correttamente.");
        header('Location: https://digitalplot.altervista.org/home'); 
    }

}