<?php

use Doctrine\ORM\EntityManager;

class PersistentManager {

    private ?FDatabase $db;
    private ?EntityManager $em;

    public function __construct() {
        $this->db = FDatabase::getInstance();
        $this->em = $this->db->getEntityManager();
    }

    // ========== Gestione CRUD ==========

    public function saveInBd(object $entity): void {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function delete(object $entity): void {
        $this->em->remove($entity);
    }

    public function clear(): void {
        $this->em->clear();
    }

    //utilizzato per l'update di un oggetto già presente nel database
    public function flush(): void {
        $this->em->flush();
    }

    public function find(string $entityClass, mixed $id): ?object {
        return $this->em->find($entityClass, $id);
    }
    // INUTILE CON IL NOSTRO APPROCCIO, molto utile per fare query su una singola tabella
    public function getRepository(string $entityClass) {
        return $this->em->getRepository($entityClass);
    }

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

}
?>
