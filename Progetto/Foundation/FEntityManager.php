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
    public static function retriveObjById( string $className, $id) : ?object {
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
     * find an object by its attribute
     * @return object || null
     * @param string $className
     * @param string $filedName
     * @param mixed $value
     * @throws Exception
     */
    public static function retriveObjByAttribute( string $className, string $filedName, $value) : ?object {
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
    public static function retriveObjList( string $tableName, string $fieldName, mixed $value) : ?array {
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
    public static function retriveObjListByTwoAtt( string $tableName, string $fieldName1, mixed $value1,string $fieldName2, mixed $value2) : ?array {
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
    public static function retriveAll(string $className): ?array {
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
     * Verify if an attribute of an object is already present in the database
     * @param string $primaryKey The primary key of the entity
     * @param string $className The class name of the entity
     * @param string $field The field to check
     * @param mixed $value The value to check
     * @return bool True if the attribute exists, false otherwise
     */
    public static function verifyAttributes(string $primaryKey, string $className, string $field, mixed $value) : bool{
        try{
            $dql = "SELECT u.$primaryKey FROM " . $className . " u WHERE u." . $field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $value);
            $result = $query->getResult();
            if(count($result) > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
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
     * delete an object from the db
     * @param object $obj
     * @return boolean
     * @throws Exception
     */
    public static function deleteObj(object $obj): bool {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->remove($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
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


    public static function retrieveSubscriptionDatePeriod(mixed $id) : ?array {
        try {
            $dql = "SELECT p.purchase_date, s.period FROM EPurchase p JOIN e.fk_subscription s WHERE p.fk_subscriber = :id ORDER BY p.purchase_date DESC";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('id', $id);
            ULogSys::toLog("query: " . $query, true);
            $result = $query->getResult();
            if(count($result) > 0){
                return $result[0];
            }else {
                return null;
            }
        }
        catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     * Retrieve all objects of a specific class
     * @param string $className
     * @return array|null
     * @throws Exception
     */
    public static function retrieveAll(string $className): ?array {
        try {
            $dql = "SELECT e FROM $className e";
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
    public static function retrieveArticles(string $className, string $title, string $type, string $genre, string $date): ?array {
        try {
            $dql = "SELECT a FROM " . $className . " a WHERE a.title = :title AND a.type = :type AND a.genre = :genre AND a.date = :date";
            $query = self::$entityManager->createQuery($dql)
                ->setParameter('title', $title)
                ->setParameter('type', $type)
                ->setParameter('genre', $genre)
                ->setParameter('date', $date);
            $query = self::$entityManager->createQuery($dql);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     *  Retrieve articles based on title, type, and genre, ignoring date
     *  @param string $className
     *  @param string $title
     *  @param string $type
     *  @param string $genre
     *  @return array|null
     *  @throws Exception
     */

    public static function retrieveArticlesNoDate(string $className, string $title, string $type, string $genre): ?array {
        try {
            $dql = "SELECT a FROM " . $className . " a WHERE a.title = :title AND a.type = :type AND a.genre = :genre";
            $query = self::$entityManager->createQuery($dql)
                ->setParameter('title', $title)
                ->setParameter('type', $type)
                ->setParameter('genre', $genre);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     *  Retrieve articles based on title, type, and date, ignoring genre
     *  @param string $className
     *  @param string $title
     *  @param string $type
     *  @param string $date
     *  @return array|null
     *  @throws Exception
     */
    public static function retrieveArticlesNoGenre(string $className, string $title, string $type, string $date): ?array {
        try {
            $dql = "SELECT a FROM " . $className . " a WHERE a.title = :title AND a.type = :type AND a.date = :date";
            $query = self::$entityManager->createQuery($dql)
                ->setParameter('title', $title)
                ->setParameter('type', $type)
                ->setParameter('date', $date);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     *  Retrieve articles based on title, genre, and date, ignoring type
     *  @param string $className
     *  @param string $title
     *  @param string $genre
     *  @param string $date
     *  @return array|null
     *  @throws Exception
     */
    public static function retrieveArticlesNoType(string $className, string $title, string $genre, string $date): ?array {
        try {
            $dql = "SELECT a FROM " . $className . " a WHERE a.title = :title AND a.genre = :genre AND a.date = :date";
            $query = self::$entityManager->createQuery($dql)
                ->setParameter('title', $title)
                ->setParameter('genre', $genre)
                ->setParameter('date', $date);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     *  Retrieve articles based on type, genre, and date, ignoring title
     *  @param string $className
     *  @param string $type
     *  @param string $genre
     *  @param string $date
     *  @return array|null
     *  @throws Exception
     */
    public static function retrieveArticlesNoTitle(string $className, string $type, string $genre, string $date): ?array {
        try {
            $dql = "SELECT a FROM " . $className . " a WHERE a.type = :type AND a.genre = :genre AND a.date = :date";
            $query = self::$entityManager->createQuery($dql)
                ->setParameter('type', $type)
                ->setParameter('genre', $genre)
                ->setParameter('date', $date);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }


    /**
     *  Retrieve articles based on genre and date, ignoring title and type
     *  @param string $className
     *  @param string $genre
     *  @param string $date
     *  @return array|null
     *  @throws Exception
     */
    public static function retrieveArticlesNoTitleNoType(string $className, string $genre, string $date): ?array {
        try {
            $dql = "SELECT a FROM " . $className . " a WHERE a.genre = :genre AND a.date = :date";
            $query = self::$entityManager->createQuery($dql)
                ->setParameter('genre', $genre)
                ->setParameter('date', $date);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }

    /**
     *  Retrieve articles based on date only
     *  @param string $className
     *  @param string $date
     *  @return array|null
     *  @throws Exception
     */
    public static function retrieveArticlesOnlyDate(string $className, string $date): ?array {
        try {
            $dql = "SELECT a FROM " . $className . " a WHERE a.date = :date";
            $query = self::$entityManager->createQuery($dql)
                ->setParameter('date', $date);
            return $query->getResult();
        } catch (Exception $e) {
            ULogSys::toLog('Error: ' . $e->getMessage(), true);
            return null;
        }
    }


}

?>