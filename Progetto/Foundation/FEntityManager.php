<?php

require_once (__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Utility" . DIRECTORY_SEPARATOR . "bootstrapDoctrine.php");

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
    public static function giveMeObjById( string $className, $id) : ?object {
        try{
            $obj = self::$entityManager->find($className, $id);
            return $obj;
        }
        catch (Exception $e){
            echo "Error: " . $e->getMessage();
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
            echo "Error: " . $e->getMessage();
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
            echo "Error: " . $e->getMessage();
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
            echo "Error: " . $e->getMessage();
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
                echo "ERROR " . $e->getMessage();
                return null;
        }
    }
    /**
     * return all the object of a specifyc table 
     * @param string $className
     * @return array || null
     * @throws Exception
     */
    public static function selectAll(string $className){
        try{
            $dql = "SELECT e FROM $className e";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            return $result;
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }
    /**
     * verify if exist an object
     * @param string $primaryKey
     * @param string $className
     * @param string $field
     * @param mixed $id
     * @return boolean
     */
    public static function verifyAttributes(string $primaryKey, string $className, string $field, mixed $id) : bool{
        try{
            $dql = "SELECT u.$primaryKey FROM " . $className . " u WHERE u." . $field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);
            $result = $query->getResult();
            if(count($result) > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return false;
            }
    }

    //------------Saving and Deleting Methods--------------
    /**
     * save one object in the db (persistance of Entity)
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
            echo "Error: " . $e->getMessage();
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
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}

?>