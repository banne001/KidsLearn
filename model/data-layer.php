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
    function insertMembers($user){
    echo"hello world";

        ///build query
        $sql = "INSERT INTO kidUsers (username, name, age, grade, passwd, isPro) 
                VALUES (:username, :name, :age, :grade, :passwd, :isPro)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //$pro = $user instanceof proUser;

        //bind the parameters
        $statement->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $statement->bindParam(':name', $user->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':name', $user->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $user->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':grade', $user->getGrade(), PDO::PARAM_INT);
        $statement->bindParam(':passwd', $user->getPasswd(), PDO::PARAM_STR);
        $statement->bindParam(':isPro', $user->getIsPro(), PDO::PARAM_INT);

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

