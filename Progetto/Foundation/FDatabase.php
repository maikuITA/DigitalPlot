<?php 

namespace Foundation;

use PDO;
use PDOException;
use Utility\LogSys;

class FDatabase {
    private static ?FDatabase $instance = null;
    private ?PDO $pdo;

    private function __construct() {
        $conf = FDatabase::readDBInfo();
        try {
            LogSys::toLog("CONESSIONE AL DATABASE EFFETTUATA");
            $this->pdo = new PDO("mysql:host={$conf['host']};dbname={$conf['dbname']}", $conf['user'], $conf['pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            LogSys::toLog("ERRORE NELLA CONNESSIONE AL DATABASE");
            $this->pdo = null;
        }
    }

    public static function getInstance(): FDatabase {
        if (self::$instance === null) {
            self::$instance = new FDatabase();
        }
        return self::$instance;
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }
    
    public function closeDbConnection(): void {
        self::$instance = null;
    }

    private static function readDBInfo(): array  {
        $jsonString = file_get_contents('Progetto/Utility/json/database.json');
        $jsonData = json_decode($jsonString, true);
        return array($jsonData["host"], $jsonData["user"], $jsonData["pass"], $jsonData["dbname"]);
    }
}

?>