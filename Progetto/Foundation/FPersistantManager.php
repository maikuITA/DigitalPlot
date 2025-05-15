<?php

class PersistentManager {

    private static $instance;

    private function __construct() {
    }

    public static function getInstance(): PersistentManager {
        if (self::$instance === null) {
            self::$instance = new PersistentManager();
        }
        return self::$instance;
    }

    // ========== Gestione CRUD ==========

    /**
     * Save an object in the database
     * @param object $entity
     * @return bool
     * @throws Exception
     */
    public function saveInBd(object $entity): bool {
        return FEntityManager::getInstance()->saveObject($entity);
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

    public function retriveUserOnUsername(string $username): ?object {
        return FEntityManager::getInstance()->retriveObjByAttribute(EUser::class, 'username', $username);
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
