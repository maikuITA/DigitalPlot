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
     * Retrieve all articles from the database
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticles(string $title, string $type, string $genre, string $date): ?array {
        return FEntityManager::getInstance()->retrieveArticles(EArticle::class, $title, $type, $genre, $date);
    }

    /**
     * Retrieve all articles from the database without date
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticlesNoDate(string $title, string $type, string $genre): ?array {
        return FEntityManager::getInstance()->retrieveArticlesNoDate(EArticle::class, $title, $type, $genre);
    }

    /**
     * Retrieve all articles from the database without type
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticlesNoGenre(string $title, string $type, string $date): ?array {
        return FEntityManager::getInstance()->retrieveArticlesNoGenre(EArticle::class, $title, $type, $date);
    }


    /**
     * Retrieve all articles from the database without genre
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticlesNoType(string $title, string $genre, string $date): ?array {
        return FEntityManager::getInstance()->retrieveArticlesNoType(EArticle::class, $title, $genre, $date);
    }

    /**
     * Retrieve all articles from the database without title
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticlesNoTitle(string $type, string $genre, string $date): ?array {
        return FEntityManager::getInstance()->retrieveArticlesNoTitle(EArticle::class, $type, $genre, $date);
    }

    /**
     * Retrieve all articles from the database without title and type
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticlesNoTitleNoType(string $genre, string $date): ?array {
        return FEntityManager::getInstance()->retrieveArticlesNoTitleNoType(EArticle::class, $genre, $date);
    }

    /**
     * Retrieve all articles from the database with only date
     * @return EArticle[]|null Array of article objects or null if none found
     */
    public function searchArticlesOnlyDate(string $date): ?array {
        return FEntityManager::getInstance()->retrieveArticlesOnlyDate(EArticle::class, $date);
    }

    /**
     * drop db
     * @return void
     */
    public function clearAll(): void{
        FEntityManager::getInstance()->dropDatabase();
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
