<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Utility' . DIRECTORY_SEPARATOR . 'config.php');

use Doctrine\ORM\Tools\SchemaTool;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Utility' . DIRECTORY_SEPARATOR . 'bootstrapDoctrine.php');
/**
 * calass for checking if the db exist and if not create it
 */
class InstallerDb
{
    /**
     * Install the database if it does not exist or is empty
     *
     * @return void
     * @throws PDOException
     */
    public static function install()
    {
        try {
            // creation of the PDO object in order to create a connection to the database
            // using the constants defined in config.php
            $db = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);

            // verify if the database exists
            $stmt = $db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
            $existingDatabase = $stmt->fetchColumn();

            // verify if the database has tables, if not, the database is considered empty
            $tables = $db->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '" . DB_NAME . "';");
            $existingTables = $tables->fetchColumn();

            // if the database does not exist or is empty, create it
            if (!$existingDatabase || $existingTables == 0) {
                $queryCreateDB = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
                $db->exec($queryCreateDB);

                // Create SchemaTool for DoctrineORM relations, by which we can create the database tables
                // using the metadata of the entities defined in the project
                $schemaTool = new SchemaTool(getEntityManager());

                // Get entity metadata by the EntityManager
                $metadata = getEntityManager()->getMetadataFactory()->getAllMetadata();

                // Create database schema
                $schemaTool->createSchema($metadata);
            }

            // If a PDOException occurs, the error will be caught and logged
        } catch (PDOException $e) {
            ULogSys::toLog("Error creating database: " . $e->getMessage(), true);
        }
    }
}
