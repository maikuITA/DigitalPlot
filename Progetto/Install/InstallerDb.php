<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR . 'Utility' . DIRECTORY_SEPARATOR . 'config.php');
use Doctrine\ORM\Tools\SchemaTool;
require_once(__DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR . 'Utility' . DIRECTORY_SEPARATOR . 'bootstrapDoctrine.php');
/**
 * calass for checking if the db exist and if not create it
 */
class InstallerDb{

    public static function install(){
        try{
            $db = new PDO("mysql:host=". DB_HOST, DB_USER, DB_PASS);

            $stmt = $db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME ."'");
            $existingDatabase = $stmt->fetchColumn();

            $tables = $db->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '" . DB_NAME ."';");
            $existingTables = $tables->fetchColumn();

            if(!$existingDatabase || $existingTables == 0){
                $queryCreateDB = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
                $db->exec($queryCreateDB);

                // Create SchemaTool for DoctrineORM relations
                $schemaTool = new SchemaTool(getEntityManager());

                // Get entity metadata
                $metadata = getEntityManager()->getMetadataFactory()->getAllMetadata();

                // Create database schema
                $schemaTool->createSchema($metadata);
            }
        }catch(PDOException $e){
            ULogSys::toLog("Error creating database: " . $e->getMessage(), true);
        }
    }

}