<?php

class FPersistentManager
{
    // ========== Singleton Pattern ==========
    private static $instance;

    private function __construct() {}

    public static function getInstance(): FPersistentManager
    {
        if (self::$instance === null) {
            self::$instance = new FPersistentManager();
        }
        return self::$instance;
    }

    // ========== CRUD operations ==========

    /**
     * Save an object in the database or update it if it already exists
     * @param object $object
     * @return bool
     * @throws Exception
     */
    public function saveInDb(object $object): bool
    {
        return FEntityManager::getInstance()->saveObj($object);
    }

    /**
     * Update a specific field of an object in the database
     * @param string $className
     * @param mixed $id
     * @param string $fieldName
     * @param mixed $value
     * @return bool
     * @throws Exception
     */
    public function updateObject(string $className, $id, string $fieldName, $value): bool
    {
        return FEntityManager::getInstance()->updateField($className, $id, $fieldName, $value);
    }


    /**
     * Delete an object in the database
     * @param object $object
     * @return bool
     * @throws Exception
     */
    public function delete(?object $object): bool
    {
        return FEntityManager::getInstance()->deleteObj($object);
    }



    /**
     * Retrive an object by its id
     * @param string $className
     * @param mixed $id
     * @return object|null
     * @throws Exception
     */
    public function retrieveObjById(string $className, $id): ?object
    {
        return FEntityManager::getInstance()->retrieveObjById($className, $id);
    }


    /**
     * Retrive an object by username
     * @param string $username
     * @return object|null
     */
    public function retrieveUserOnUsername(string $username): ?object
    {
        return FEntityManager::getInstance()->retrieveObjByAttribute(EUser::class, 'username', $username);
    }

    /**
     * Retrieve an array of article, its sized is specified by the parameter
     * @param int $articlesNum Number of articles to retrieve
     * @return EArticle[]|null Array of article objects or null, if none found
     */
    public function getCasualArticles(int $articlesNum): ?array
    {
        return FEntityManager::getInstance()->selectNotAllArticles(EArticle::class, $articlesNum);
    }

    /**
     * Retrieve all objects of a specific class
     * @param string $className
     * @return array|null
     */
    public function retrieveAll(string $className): ?array
    {
        return FEntityManager::getInstance()->retrieveAll($className);
    }

    /**
     * drop the database
     * @return void
     */
    public function clearAll(): void
    {
        FEntityManager::getInstance()->dropDatabase();
    }




    //------------ Ad Hoc Methods --------------

    /**
     * Retrieve all articles from the database
     * @param string $title
     * @param string $category
     * @param string $genre
     * @param string $releaseDate
     * @return EArticle[]|null Array of article objects or null, if none found
     */
    public function searchArticles(string $title, string $category, string $genre, string $releaseDate): ?array
    {
        return FEntityManager::getInstance()->retrieveArticles(EArticle::class, $title, $category, $genre, $releaseDate);
    }





    /**
     * Check if a user is subscribed or not, if the subscription is expired, it will set the user privilege to BASIC
     * @param mixed $id of the user to check
     * @return bool
     */
    public static function isSubbed(mixed $id): bool
    {
        if (FEntityManager::getInstance()->verifyExists(EUser::class, $id)) {
            $user = FEntityManager::getInstance()->retrieveObjById(EUser::class, $id);
            if ($user->getPrivilege() === READER || $user->getPrivilege() === WRITER) {
                $notExpiredPurch = FEntityManager::getInstance()->retrieveValidPurchase();
                if ($notExpiredPurch === null) {
                    FEntityManager::getInstance()->updateField(EUser::class, $id, 'privilege', BASIC);
                    return false;
                }
                $notExpiredPurch = array_filter($notExpiredPurch, function ($purchase) use ($id) {
                    return $purchase->getSubscriber()->getId() === $id; // Filter purchases by user ID
                });
                if (count($notExpiredPurch) > 0) {
                    return true;
                } else {
                    FEntityManager::getInstance()->updateField(EUser::class, $id, 'privilege', BASIC);
                    return false;
                }
            } elseif ($user->getPrivilege() === BASIC) {
                return false;
            } elseif ($user->getPrivilege() === ADMIN) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retrieve all objects of a specific class
     * @return array|null
     */
    public function retrieveAllSubscriptions(): ?array
    {
        return FEntityManager::getInstance()->retrieveAllSubscriptions();
    }


    /**
     * Retrieve all objects of a specific class with a specific attribute
     * @param string $className
     * @param string $attribute
     * @param string $value
     * @return int
     */
    public function retrieveNumOnDate(string $className, string $numericField, string $value): int
    {
        return FEntityManager::getInstance()->countRecordWithDate($className, $numericField, $value);
    }


    /**
     * Count the number of records of a specific class
     * @param string $className
     * @return int
     */
    public function countRecord(string $className): int
    {
        return FEntityManager::getInstance()->countRecord($className);
    }


    /**
     * Count the number of active subscribers
     * @return int
     */
    public function countActiveSubsriber(): int
    {
        return FEntityManager::getInstance()->countActiveSubsriber();
    }


    /**
     * Retrieve all articles that are pending review
     */
    public static function retrievePendingArticles()
    {
        return FEntityManager::getInstance()->retrievePendingArticles();
    }


    /**
     * Retrieve all reviews from the database
     */
    public static function retrieveAllReview()
    {
        return FEntityManager::getInstance()->retrieveAllReview();
    }
}
