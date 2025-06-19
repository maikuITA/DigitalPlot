<?php

class CService{

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
        if (count($allData) > 0 && count($allData) === 13) {
            // Database is not empty, do not populate
            echo "Database already populated.";
            
        } elseif (count($allData) > 0) {
            // Populate entirely the db
            FPersistentManager::getInstance()->clearAll();
            InstallerDb::install();
            BasicEntry::populateDb();
            echo "Database populated successfully.";
        } 
    }

}
