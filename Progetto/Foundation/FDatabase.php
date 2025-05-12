<?php


use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__."/../Utility/config.php";
require_once __DIR__."/../../vendor/autoload.php";

class FDatabase{
    
    private static ?FDatabase $istance = null;
    private ?EntityManager $entityManager;

    private function __construct() {
        global $conn;
        // Configurazione di Doctrine
        $config = ORMSetup::createAttributeMetadataConfiguration(paths: [__DIR__ . "/Progetto/Entity/"], isDevMode: true);

        $connessione = DriverManager::getConnection($conn, $config);

        // Creazione dell'EntityManager rappresentativo delle classi di foundation
        $this->entityManager = new EntityManager($connessione, $config);
    }

    /**
     * @return FDatabase
     */
    // Singleton per ottenere l'istanza di FDatabase
    public static function getInstance() {
        if (self::$istance === null) {
            self::$istance = new FDatabase();
        }
        return self::$istance;
    }
    /**
     * @return EntityManager
     */
    // Restituisce l'EntityManager, che gestisce le entità nel database
    public function getEntityManager() : EntityManager {
        return $this->entityManager;
    }
    /**
     * Chiude la connessione al database
     */
    public function closeConnection() {
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

?>