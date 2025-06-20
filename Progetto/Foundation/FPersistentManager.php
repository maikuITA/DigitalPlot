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
    public function saveInBd(object $entity): bool {
        return FEntityManager::getInstance()->saveObj($entity);
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

    /**
     * Retrive an object by its id
     * @param string $className
     * @param mixed $id
     * @return object || null
     * @throws Exception
     */
    public function retriveObjById(string $className, $id): ?object {
        return FEntityManager::getInstance()->retriveObjById($className, $id);
    }

    /**
     * Retrive an object by a specific attribute
     * @param string $username
     * @return object || null
     */
    public function retriveUserOnUsername(string $username): ?object {
        return FEntityManager::getInstance()->retriveObjByAttribute(EUser::class, 'username', $username);
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
    public function retriveAll(string $className): ?array {
        return FEntityManager::getInstance()->retriveAll($className);
    }

    /**
     * drop db
     * @return void
     */
    public function clearAll(): void{
        FEntityManager::getInstance()->dropDatabase();
    }

    public static function isSubbed(mixed $id) : bool {
        if(FEntityManager::getInstance()->verifyAttributes('user_id', ESubscriber::class, 'user_id', $id)) {
            $purch_date = FEntityManager::getInstance()->retrieveSubscriptionDatePeriod($id);
            ULogSys::toLog("Succhia: " . var_dump($purch_date), true);
            return true;
        } else {
            return false;
        }
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
