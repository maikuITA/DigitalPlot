<?php

require_once (__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Utility" . DIRECTORY_SEPARATOR . "bootstrapDoctrine.php");
use Doctrine\ORM\Tools\SchemaTool;
use Exception;

class FEntityManager {

    private static $istance;
    private static $entityManager;

    private function __construct() {
        self::$entityManager = getEntityManager();
    }

    public static function getInstance() {
        if (self::$istance === null) {
            self::$istance = new FEntityManager();
        }
        return self::$istance;
    }

    public static function getEntityManager() {
        return self::$entityManager;
    }
    //-------------Searching Methods-------------------
    /**
     * find an object by its id
     * @return object || null
     * @param string $className
     * @param mixed $id
     * @throws Exception
     */
    public static function retrieveObjById( string $className, $id) : ?object {
        try{
            $obj = self::$entityManager->find($className, $id);
            return $obj;
        }
        catch (Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Update a single field of an object in the database.
     *
     * @param string $className Il nome completo della classe dell'entità (es. EUser::class)
     * @param mixed $id L'ID dell'entità da aggiornare
     * @param string $fieldName Il nome del campo da aggiornare (es. 'email')
     * @param mixed $newValue Il nuovo valore da assegnare
     * @return bool true se aggiornato correttamente, false altrimenti
     * @throws Exception
     */
    public static function updateField(string $className, $id, string $fieldName, $newValue): bool {
        try {
            $obj = self::$entityManager->find($className, $id);

            if (!$obj) {
                ULogSys::toLog("Object not found by ID: $id", true);
                return false;
            }

            $setter = 'set' . ucfirst($fieldName);
            if (!method_exists($obj, $setter)) {
                ULogSys::toLog("$setter method not exists in $className", true);
                return false;
            }

            $obj->$setter($newValue);
            self::$entityManager->flush();  //update the object in the databas
            return true;

        } catch (Exception $e) {
            ULogSys::toLog("Error, field - $fieldName" . $e->getMessage(), true);
            return false;
        }
    }


    /**
     * find an object by its attribute
     * @return object || null
     * @param string $className
     * @param string $filedName
     * @param mixed $value
     * @throws Exception
     */
    public static function retrieveObjByAttribute( string $className, string $filedName, $value) : ?object {
        try{
            $obj = self::$entityManager->getRepository($className)->findOneBy([$filedName => $value]);
            return $obj;
        }
        catch (Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * find all objects of a class with a specific attribute
     * @param string $className
     * @param string $fieldName
     * @param mixed $value
     * @return array || null
     * @throws Exception
     */
    public static function retrieveObjList( string $tableName, string $fieldName, mixed $value) : ?array {
        try{
            $dql = "SELECT e FROM $tableName e WHERE e.$fieldName = :value"; // value è un placeholder e serve per evitare SQL injection
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('value', $value);
            $result = $query->getResult();
            if(count($result) > 0){
                return $result;
            }else{
                return null;
            }
        }
        catch (Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * find an objects of a class with 2 specific attributes
     * @param string $className
     * @param string $fieldName1
     * @param mixed $value1
     * @param string $fieldName2
     * @param mixed $value2
     * @return object || null
     * @throws Exception
     */
    public static function retrieveObjListByTwoAtt( string $tableName, string $fieldName1, mixed $value1,string $fieldName2, mixed $value2) : ?array {
        try{
            $dql = "SELECT e FROM $tableName e WHERE e.$fieldName1 = :value1 AND e.$fieldName2 = :value2"; 
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('value1', $value1);
            $query->setParameter('value2', $value2);
            $result = $query->getOneOrNullResult();
            return $result;
        }
        catch (Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * return all the object of a specifyc table where the field value is null(ex. all the report)
     * @param string $className
     * @param string $field
     * @return array || null
     * @throws Exception
     */
    public static function objectListUsingNull(string $className, string $field){
        try{
            $dql = "SELECT e FROM " . $className . " e WHERE e." .$field. " IS NULL";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            if(count($result) > 0){
                return $result;
            }else{
                return null;
            }
        }catch(Exception $e){
                ULogSys::toLog('Error: ' . $e->getMessage(), true);
                return null;
        }
    }
    /**
     * return all the object of a specifyc table 
     * @param string $className
     * @return array || null
     * @throws Exception
     */
    public static function retrieveAll(string $className): ?array {
        try{
            $dql = "SELECT e FROM $className e";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            return $result;
        }catch(Exception $e){
            ULogSys::toLog('Error -> ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * return a specified number of object of a specifyc table 
     * @param string $className
     * @param int $articlesNum
     * @return EArticle[] | null
     * @throws Exception
     */
    public static function selectNotAll(string $className, int $articlesNum): ?array {
        try{
            $dql = "SELECT e FROM $className e";
            $query = self::$entityManager->createQuery($dql);
            $resultpart = $query->getResult();
            shuffle($resultpart); // Shuffle the array to get a random order
            array_slice($resultpart, 0, $articlesNum); // Get the first $articlesNum elements
            return $resultpart;
        }catch(Exception $e) {
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
    public static function verifyExists( string $className, mixed $value) : bool{
        try{
            $dql = "SELECT u.id FROM " . $className . " u WHERE u.id = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $value);
            $result = $query->getResult();
            if(count($result) > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            ULogSys::toLog('Error verifing Attributes: ' . $e->getMessage(), true);
            return false;
        }
    }

    //------------Saving and Deleting Methods--------------
    /**
     * save one object in the db (persistance of Entity) or update it
     * @param object $obj
     * @return boolean
     * @throws Exception
     */
    public static function saveObj( object $obj): bool {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return false;
        }
    }

    /**
     * save an array of objects in the db (persistance of Entity) or update it
     * @return object $object
     * @return void
     * @throws Exception
     */
    public static function addObj(object $object): void {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->persist($object);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
        }catch(Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            self::$entityManager->getConnection()->rollBack();
        }
    }

    /**
     * delete an object from the db
     * @param object $obj
     * @return boolean
     * @throws Exception
     */
    public static function deleteObj(string $className, object $obj): bool {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            $managedObj = self::$entityManager->find($className, $obj->getId());
            ULogSys::toLog('prova4', true);
            if ($managedObj !== null){
                self::$entityManager->remove($obj);
                self::$entityManager->flush();
                ULogSys::toLog('prova2', true);
                self::$entityManager->getConnection()->commit();
                return true;
            }
            ULogSys::toLog('Error: object not exists', true);
            return false;
        }catch(Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return false;
        }
    }



    public static function dropDatabase(): void {
        try {
            $connection = self::$entityManager->getConnection();
            $connection->beginTransaction();
            $metadata = self::$entityManager->getMetadataFactory()->getAllMetadata();
            if (!empty($metadata)) {
                $tool = new SchemaTool(self::$entityManager);
                $tool->dropDatabase(); // Elimina completamente il DB (tabelle + schema)
            }
            $connection->commit();
        } catch (Exception $e) {
            ULogSys::toLog('Error during dropping database: ' . $e->getMessage(), true);
            self::$entityManager->getConnection()->rollBack();
        }
    }

    public static function retrieveValidPurchase() : ?array {
        try {
            $dql = "SELECT p FROM EPurchase p WHERE p.expireDate > CURRENT_DATE()";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            if(count($result) > 0){
                return $result;
            }else {
                return null;
            }
        }
        catch (Exception $e) {
            ULogSys::toLog('Error purchase: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Retrieve all objects of a specific class
     * @param string $className
     * @return array|null
     * @throws Exception
     */
    public static function retrieveAllSubscriptions(): ?array {
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
     * @param string $date
     * @return array|null
     * @throws Exception
     */
    public static function retrieveArticles(string $className, string $title, string $category, string $genre, string $releaseDate): ?array {
        try {
            $dql = "SELECT a FROM $className a 
                    WHERE a.title LIKE :title 
                    AND a.category LIKE :category 
                    AND a.genre LIKE :genre 
                    AND a.releaseDate >= :releaseDate 
                    ORDER BY a.title DESC, a.releaseDate";

            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('title', $title);
            $query->setParameter('category', $category);
            $query->setParameter('genre', $genre);
            $query->setParameter('releaseDate', $releaseDate);
            $results = $query->getResult();
            ULogSys::toLog("Query returned " . count($results) . " result(s).", true);
            return $results;

        } catch (\Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }
}

?>