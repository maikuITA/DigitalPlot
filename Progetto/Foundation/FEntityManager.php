<?php

// in this way we have an istance of the EntityManager
require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Utility" . DIRECTORY_SEPARATOR . "bootstrapDoctrine.php");

use Doctrine\ORM\Tools\SchemaTool;
use Exception;

class FEntityManager
{

    // Singleton instance
    private static $istance;
    private static $entityManager;

    private function __construct()
    {
        self::$entityManager = getEntityManager();
    }

    public static function getInstance()
    {
        if (self::$istance === null) {
            self::$istance = new FEntityManager();
        }
        return self::$istance;
    }

    public static function getEntityManager()
    {
        return self::$entityManager;
    }



    //-------------Searching Methods-------------------
    /**
     * Find an object by its id
     * @param string $className
     * @param mixed $id
     * @return object|null
     * @throws Exception
     */
    public static function retrieveObjById(string $className, $id): ?object
    {
        try {
            $obj = self::$entityManager->find($className, $id);
            return $obj;
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Update a single field of an object in the database.
     * @param string $className (es. EUser::class)
     * @param mixed $id the object's id to update
     * @param string $fieldName the field's name to update (es. 'email')
     * @param mixed $newValue the new value to set for the field
     * @return bool true if the update has been properly, false otherwise
     * @throws Exception
     */
    public static function updateField(string $className, $id, string $fieldName, $newValue): bool
    {
        try {
            self::$entityManager->getConnection()->beginTransaction();
            $obj = self::$entityManager->find($className, $id);

            if (!$obj) {
                ULogSys::toLog("Object not found by ID: $id", true);
                self::$entityManager->getConnection()->rollBack();
                return false;
            }

            $setter = 'set' . ucfirst($fieldName);
            if (!method_exists($obj, $setter)) {
                self::$entityManager->getConnection()->rollBack();
                ULogSys::toLog("$setter method not exists in $className", true);
                return false;
            }

            $obj->$setter($newValue);
            self::$entityManager->flush();  //update the object in the databas
            self::$entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            ULogSys::toLog("Error, field - $fieldName" . $e->getMessage(), true);
            return false;
        }
    }


    /**
     * Find an object by its attribute
     * @param string $className
     * @param string $filedName
     * @param mixed $value
     * @return object|null
     * @throws Exception
     */
    public static function retrieveObjByAttribute(string $className, string $filedName, $value): ?object
    {
        try {
            // the repository represents the entity class
            $obj = self::$entityManager->getRepository($className)->findOneBy([$filedName => $value]);
            return $obj;
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Return all the object of a specifyc table 
     * @param string $className
     * @return array|null
     * @throws Exception
     */
    public static function retrieveAll(string $className): ?array
    {
        try {
            $dql = "SELECT e FROM $className e";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            return $result;
        } catch (Exception $e) {
            ULogSys::toLog('Error -> ' . $e->getMessage(), true);
            return null;
        }
    }


    //-------------Ad Hoc Methods-------------------

    /**
     * Return a specified number of approved Articles from the database 
     * @param string $className
     * @param int $articlesNum
     * @return EArticle[]|null
     * @throws Exception
     */
    public static function selectNotAllArticles(string $className, int $articlesNum): ?array
    {
        try {
            $dql = "SELECT e FROM $className e WHERE e.state = :stat";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('stat', APPROVED);
            $resultpart = $query->getResult();
            shuffle($resultpart); // Shuffle the array to get a random order
            return array_slice($resultpart, 0, $articlesNum); // Get the first $articlesNum elements
        } catch (Exception $e) {
            ULogSys::toLog('Error -> ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Verify if an object with a specific attribute exists in the database
     * @param string $className
     * @param mixed $value
     * @return bool
     * @throws Exception
     */
    public static function verifyExists(string $className, mixed $value): bool
    {
        try {
            $dql = "SELECT u.id FROM  $className u WHERE u.id = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $value);
            $result = $query->getResult();
            if (count($result) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            ULogSys::toLog('Error verifing Attributes: ' . $e->getMessage(), true);
            return false;
        }
    }

    /**
     * Retrieve all valid purchases from the database
     * @return array|null
     * @throws Exception
     */
    public static function retrieveValidPurchase(): ?array
    {
        try {
            $dql = "SELECT p FROM EPurchase p WHERE p.expireDate > CURRENT_DATE()";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            if (count($result) > 0) {
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            ULogSys::toLog('Error purchase: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Retrieve all objects of a specific class
     * @return array|null
     * @throws Exception
     */
    public static function retrieveAllSubscriptions(): ?array
    {
        try {
            $dql = "SELECT e FROM ESubscription e ORDER BY e.type DESC";
            $query = self::$entityManager->createQuery($dql);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Retrieve articles based on specific criteria
     * @param string $className
     * @param string $title
     * @param string $type
     * @param string $genre
     * @param string $releaseDate
     * @param string $date
     * @return array|null
     * @throws Exception
     */
    public static function retrieveArticles(string $className, string $title, string $category, string $genre, string $releaseDate, string $state = APPROVED): ?array
    {
        try {
            $dql = "SELECT a FROM $className a 
                    WHERE a.title LIKE :title 
                    AND a.category LIKE :category 
                    AND a.genre LIKE :genre 
                    AND a.releaseDate >= :releaseDate 
                    AND a.state = :stat
                    ORDER BY a.releaseDate DESC, a.title";

            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('stat', $state);
            $query->setParameter('title', $title);
            $query->setParameter('category', $category);
            $query->setParameter('genre', $genre);
            $query->setParameter('releaseDate', $releaseDate);
            $results = $query->getResult();
            ULogSys::toLog("Query returned " . count($results) . " result(s).");
            return $results;
        } catch (\Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Counts the number of records in the specified entity class where the given numeric field 
     * is greater than or equal to the provided value.
     * This method dynamically builds a DQL query to count records that match the given condition.
     *
     * @param string $className   
     * @param string $numericField  The name of the numeric field to compare (must exist in the entity).
     * @param string $value         The threshold value to compare against (as string, will be passed as a parameter).
     * @return int The number of matching records.
     */
    public static function countRecordWithDate(string $className, string $numericField, string $value): int
    {
        try {
            $dql = "SELECT COUNT(a) FROM $className a WHERE a.$numericField >= :value";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('value', $value);
            return (int) $query->getSingleScalarResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error purchase: ' . $e->getMessage(), true);
            return 0;
        }
    }

    /**
     * This method count the number of record in the selected table
     * @param string $className 
     * @return int the number of record
     */
    public static function countRecord(string $className): int
    {
        try {
            $dql = "SELECT COUNT(a) FROM $className a ";
            $query = self::$entityManager->createQuery($dql);
            return (int) $query->getSingleScalarResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error purchase: ' . $e->getMessage(), true);
            return 0;
        }
    }
    /**
     * This method counts the number of the subscriber, except admin 
     * @return int|null number of the subscriber
     */
    public static function countActiveSubsriber(): ?int
    {
        try {
            $dql = "SELECT COUNT(a) FROM EUser a WHERE a.privilege BETWEEN " . READER . " AND " . WRITER;
            $query = self::$entityManager->createQuery($dql);
            return (int) $query->getSingleScalarResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error purchase: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Retrieve all pending articles
     * @return array|null
     * @throws Exception
     */
    public static function retrievePendingArticles(): ?array
    {
        try {
            $dql = "SELECT p FROM EArticle p WHERE p.state = :stat ORDER BY p.releaseDate DESC";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('stat', PENDING);
            $result = $query->getResult();
            if (count($result) > 0) {
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            ULogSys::toLog('Error purchase: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Retrieve all reviews ordered by release date
     * @return array|null
     * @throws Exception
     */
    public static function retrieveAllReview(): ?array
    {
        try {
            $dql = "SELECT p FROM EReview p ORDER BY p.releaseDate DESC";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            if (count($result) > 0) {
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            ULogSys::toLog('Error purchase: ' . $e->getMessage(), true);
            return null;
        }
    }



    //------------Saving and Deleting Methods--------------
    /**
     * Save an object in the db or update it
     * @param object $obj
     * @return boolean
     * @throws Exception
     */
    public static function saveObj(object $obj): bool
    {
        try {
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            self::$entityManager->getConnection()->rollBack();
            return false;
        }
    }

    /**
     * Delete an object from the db
     * @param object $obj
     * @return boolean
     * @throws Exception
     */
    public static function deleteObj(object $obj): bool
    {
        try {
            self::$entityManager->getConnection()->beginTransaction();
            if ($obj !== null) {
                self::$entityManager->remove($obj);
                self::$entityManager->flush();
                self::$entityManager->getConnection()->commit();
                return true;
            } else {
                ULogSys::toLog('Error: object not exists', true);
                return false;
            }
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            self::$entityManager->getConnection()->rollBack();
            return false;
        }
    }

    /**
     * Drop the database, removing all tables and schema.
     * This method should be used with caution as it will delete all data.
     * @return void
     * @throws Exception
     */
    public static function dropDatabase(): void
    {
        try {
            $connection = self::$entityManager->getConnection();
            $connection->beginTransaction();
            $metadata = self::$entityManager->getMetadataFactory()->getAllMetadata();
            if (!empty($metadata)) {
                $tool = new SchemaTool(self::$entityManager);
                $tool->dropDatabase(); // This will drop all tables in the database
                ULogSys::toLog('Database dropped successfully.');
                $connection->commit();
            } else {
                ULogSys::toLog('No metadata found, nothing to drop.', true);
                self::$entityManager->getConnection()->rollBack();
            }
        } catch (Exception $e) {
            ULogSys::toLog('Error during dropping database: ' . $e->getMessage(), true);
            self::$entityManager->getConnection()->rollBack();
        }
    }
}
