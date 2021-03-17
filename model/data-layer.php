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
        $name = $user->getFname() . " " . $user->getLname();
        $statement->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $statement->bindParam(':name', $name , PDO::PARAM_STR);
        //$statement->bindParam(':name', $user->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $user->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':grade', $user->getGrade(), PDO::PARAM_INT);
        $statement->bindParam(':passwd', $user->getPasswd(), PDO::PARAM_STR);
        $statement->bindParam(':isPro', $user->getIsPro(), PDO::PARAM_INT);
        $statement->bindParam(':subject', $subject, PDO::PARAM_STR);

        //process results
        $statement->execute();
    }

    function insertCreation($create, $user){
        //echo "I HAVE CREATTED SOMETHINGGG";
        ///build query
        $sql = "INSERT INTO creations (name, description, object, user_id, image) 
                VALUES (:name, :description, :object, :user_id, :image)";
        //var_dump($create);
        //var_dump($user);
        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //bind the parameters
        $statement->bindParam(':name', $create->getName(), PDO::PARAM_STR);
        $statement->bindParam(':description', $create->getDesc(), PDO::PARAM_STR);
        $statement->bindParam(':object', $create->getObject(), PDO::PARAM_STR);
        $statement->bindParam(':user_id', $user->getUserId(), PDO::PARAM_INT);
        $statement->bindParam(':image', $create->getImage(), PDO::PARAM_STR);

        //process results
        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);

    }

    function getUser($username, $password){
        $sql = "SELECT * FROM kidUsers WHERE username = :name AND passwd = :password";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':name', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);

        if($statement->rowCount() == 0){
            return false;
        } else {
            return $result;
        }
    }

    function getCreations($userId){
        $sql = "SELECT creations.name, description, object, image FROM `creations`, `kidUsers` 
                WHERE kidUsers.user_id = creations.user_id AND creations.user_id = :id";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':id', $userId, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
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

