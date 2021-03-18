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
        //echo "hello world";

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
        $pw = sha1($user->getPasswd());
        $statement->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $statement->bindParam(':name', $name , PDO::PARAM_STR);
        //$statement->bindParam(':name', $user->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $user->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':grade', $user->getGrade(), PDO::PARAM_INT);
        $statement->bindParam(':passwd', $pw, PDO::PARAM_STR);
        $statement->bindParam(':isPro', $user->getIsPro(), PDO::PARAM_INT);
        $statement->bindParam(':subject', $subject, PDO::PARAM_STR);

        //process results
        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);

    }
    //function for checking if the user already exists in the database
    public function userExists($username)
    {

        //prepared statements for added security $this->_dbh->prepare
        $query = $this->_dbh->prepare("SELECT COUNT(`username`) FROM kidUsers WHERE username = ?");
        $query->bindValue(1, $username);

        try {
            //execute the query
            $query->execute();
            $rows = $query->fetchColumn();

            //if a row is returned...user already exists
            if ($rows == 1) {
                return true;
            } else {
                return false;
            }
            //catch the exception
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function insertCreation($create, $user){
        //echo "I HAVE CREATTED SOMETHINGGG";
        ///build query
        $sql = "INSERT INTO creations (name, description, object, username, image) 
                VALUES (:name, :description, :object, :username, :image)";
        //var_dump($create);
        //var_dump($user);
        //prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //echo "THIS IS THE USERNAME: " . $user->getUsername();
        //bind the parameters
        $statement->bindParam(':name', $create->getName(), PDO::PARAM_STR);
        $statement->bindParam(':description', $create->getDesc(), PDO::PARAM_STR);
        $statement->bindParam(':object', $create->getObject(), PDO::PARAM_STR);
        $statement->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $statement->bindParam(':image', $create->getImage(), PDO::PARAM_STR);


        //process results
        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);

    }

    function getUser($username, $password){
        $sql = "SELECT * FROM kidUsers WHERE username = :name AND passwd = :password";

        $statement = $this->_dbh->prepare($sql);
        $pw = sha1($password);

        $statement->bindParam(':name', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $pw, PDO::PARAM_STR);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);

        if($statement->rowCount() == 0){
            return false;
        } else {
            return $result;
        }
    }

    function getCreations($username){
        //echo "INSIDE A HERRE". $username;
        $sql = "SELECT creations.name, description, object, image FROM `creations`, `kidUsers` 
                WHERE kidUsers.username = creations.username AND creations.username = :username";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);

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

