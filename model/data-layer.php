<?php

class DataLayer{

    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * insertion to member table
     * @param $user Object
     */
    function insertUser($user){
    //echo"hello world";

        ///build query
        $sql = "INSERT INTO kidUsers (username, name, age, grade, passwd, isPro, subject) 
                VALUES (:username, :name, :age, :grade, :passwd, :isPro, :subject)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //$pro = $user instanceof proUser;
        $subject = "";
        if($user instanceof ProUser){
            $subject = $user->getSubject();
        }
        //bind the parameters
        $statement->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $statement->bindParam(':name', $user->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':name', $user->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $user->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':grade', $user->getGrade(), PDO::PARAM_INT);
        $statement->bindParam(':passwd', $user->getPasswd(), PDO::PARAM_STR);
        $statement->bindParam(':isPro', $user->getIsPro(), PDO::PARAM_INT);
        $statement->bindParam(':subject', $subject, PDO::PARAM_STR);

        //process results
        $statement->execute();
    }

    function insertCreation($proUser){

        ///build query
        $sql = "INSERT INTO creations (name, description, object, user_id, image) 
                VALUES (:name, :description, :object, :user_id, :image)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //$pro = $user instanceof proUser;

        //bind the parameters
        $statement->bindParam(':name', $proUser->getName(), PDO::PARAM_STR);
        $statement->bindParam(':description', $proUser->getDesc(), PDO::PARAM_STR);
        $statement->bindParam(':object', $proUser->getObject(), PDO::PARAM_STR);
        $statement->bindParam(':user_id', $proUser-> getUserId(), PDO::PARAM_INT);
        $statement->bindParam(':image', $proUser->getImage(), PDO::PARAM_STR);

        //process results
        $statement->execute();

    }

        /**
         * @return Array a limited list of indoor interests
         */
    function getTypes()
    {
        return array('shapes', 'animals', 'fruits');
    }

    /**
     * @return Array of accepatable type of pictures
     */
    function getExtensions(){
        return array('png', 'jpeg', 'jpg');
    }
}

