<?php

namespace Foundation;

class FPersistantManager {
    // Da rifare
    private static $instance = null;
    private $entityManager;

    private function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public static function getInstance($entityManager) {
        if (self::$instance === null) {
            self::$instance = new self($entityManager);
        }
        return self::$instance;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }
}

?>