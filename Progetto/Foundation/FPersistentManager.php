<?php

class FPersistentManager {

    private static $instance;

    private function __construct() {
    }

    public static function getInstance(): FPersistentManager {
        if (self::$instance === null) {
            self::$instance = new FPersistentManager();
        }
        return self::$instance;
    }

    // ========== Gestione CRUD ==========

    /**
     * Save an object in the database or update it if it already exists
     * @param object $entity
     * @return bool
     * @throws Exception
     */
    public function saveInDb(object $entity): bool {
        return FEntityManager::getInstance()->saveObj($entity);
    }
    /**
     * Add an object in the database
     * @param object $entity
     * @return bool
     * @throws Exception
     */
    public function insertInDb(object $entity): bool {
        return FEntityManager::getInstance()->addObj($entity);
    }

    public function updateObject(string $className, $id, string $fieldName, $value): bool {
        return FEntityManager::getInstance()->updateField($className, $id, $fieldName, $value);
    }


    /**
     * Delete an object in the database
     * @param object $entity
     * @return bool
     * @throws Exception
     */
    public function delete(object $entity): bool {
        return FEntityManager::getInstance()->deleteObj($entity);
    }

    public function deleteArticleById(string $className, $idArticle): bool{
        return FEntityManager::getInstance()->deleteArticleById($className, $idArticle);
    }

    /**
     * Retrive an object by its id
     * @param string $className
     * @param mixed $id
     * @return object || null
     * @throws Exception
     */
    public function retrieveObjById(string $className, $id): ?object {
        return FEntityManager::getInstance()->retrieveObjById($className, $id);
    }

    /**
     * Retrive an object by a specific attribute
     * @param string $username
     * @return object || null
     */
    public function retrieveUserOnUsername(string $username): ?object {
        return FEntityManager::getInstance()->retrieveObjByAttribute(EUser::class, 'username', $username);
    }

    /**
     * Retrieve an array of article, its sized is specified by the parameter
     * @param int $articlesNum Number of articles to retrieve
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function getCasualArticles(int $articlesNum): array {
        return FEntityManager::getInstance()->selectNotAll(EArticle::class, $articlesNum);
    }

    /**
     * Check if an email already exists in the database
     * @param string $email
     * @return bool
     */
    public function checkIfExistEmail(string $email): bool{
        return FEntityManager::getInstance()->verifyAttributes('user_id',EUser::class, 'email', $email);
    }

    /**
     * Check if a username already exists in the database
     * @param string $username
     * @return bool
     */
    public function checkIfExistUsername(string $username): bool{
        return FEntityManager::getInstance()->verifyAttributes('user_id',EUser::class, 'username', $username);
    }

    /**
     * Check if a telephone already exists in the database
     * @param string $telephone
     * @return bool
     */
    public function checkIfExistTelephone(string $telephone): bool{
        return FEntityManager::getInstance()->verifyAttributes('user_id',EUser::class, 'telephone', $telephone);
    }

    /**
     * Check if a user has been added properly
     * @param int $id
     * @return bool
     */
    public function checkIfExistUser(int $id): bool{
        return FEntityManager::getInstance()->verifyAttributes('user_id',EUser::class, 'id', $id);
    }

    /**
     *  Retrieve all objects of a specific class
     * @param string $className
     * @return array | null
     */
    public function retrieveAll(string $className): ?array {
        return FEntityManager::getInstance()->retrieveAll($className);
    }

    /**
     * Retrieve all articles from the database
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticles(string $title, string $category, string $genre, string $releaseDate): ?array {
        return FEntityManager::getInstance()->retrieveArticles(EArticle::class, $title, $category, $genre, $releaseDate);
    }


    /**
     * drop db
     * @return void
     */
    public function clearAll(): void{
        FEntityManager::getInstance()->dropDatabase();
    }

    /**
     * Check if a user is subscribed or not, if the subscription is expired, it will set the user privilege to BASIC
     * @param mixed $id
     * @return bool
     */
    public static function isSubbed(mixed $id) : bool {
        if(FEntityManager::getInstance()->verifyExists(EUser::class, $id)) {
            $user = FEntityManager::getInstance()->retrieveObjById(EUser::class, $id);
            if ($user->getPrivilege() === READER || $user->getPrivilege() === WRITER) {
                $notExpiredPurch = FEntityManager::getInstance()->retrieveValidPurchase();
                if ($notExpiredPurch === null) {
                    FEntityManager::getInstance()->updateField(EUser::class, $id, 'privilege', BASIC);
                    return false;
                }
                $notExpiredPurch = array_filter($notExpiredPurch, function($purchase) use ($id) {
                    return $purchase->getSubscriber()->getId() === $id;
                });
                if (count($notExpiredPurch) > 0) {
                    return true;
                } 
                else{
                    FEntityManager::getInstance()->updateField(EUser::class, $id, 'privilege', BASIC);
                    return false;
                }
            }
            elseif ($user->getPrivilege() === BASIC) {
                return false;
            }
            elseif ($user->getPrivilege() === ADMIN) {
                return true;
            }
        }
        return false;
    }

    /**
     *  Retrieve all objects of a specific class
     * @param string $className
     * @return array | null
     */
    public function retrieveAllSubscriptions(): ?array {
        return FEntityManager::getInstance()->retrieveAllSubscriptions();
    }
    

    /*
    // ========== Query DQL personalizzate ==========

    public function runDqlQuery(string $dql, array $params = []): array {
        $query = $this->em->createQuery($dql);
        foreach ($params as $key => $value) {
            $query->setParameter($key, $value);
        }
        return $query->getResult();
    }

    // ========== Query SQL native ==========

    public function runNativeQuery(string $sql, array $params = [], array $types = []): array {
        $conn = $this->em->getConnection();
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery($params);
        return $result->fetchAllAssociative();
    }

    // ========== Utility ==========
    //Ripristina lo stato dell'oggetto passato come parametro, riportandolo allo stato del database
    public function refresh(object $entity): void {
        $this->em->refresh($entity);
    }

    //Rende un oggetto non più odificabile, ma non lo elimina dal database
    public function detach(object $entity): void {
        $this->em->detach($entity);
    }
    */

}
?>
