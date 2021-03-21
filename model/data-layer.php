<?php

class DataLayer{

    private $_dbh;

    /**
     * DataLayer constructor.
     * @param $dbh
     */
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

    /**
     * function for checking if the user already exists in the database
     * @param $username
     * @return bool
     */
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

    /**
     * function for insertion of creations table
     * @param $create
     * @param $user
     */
    function insertCreation($create, $user){

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

    /**
     * function for getting the username and password for sign in
     * @param $username
     * @param $password
     * @return false
     */
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

    /**
     * function for getting the creation of pro User
     * @param $username
     * @return mixed
     */
    function getCreations($username){
        //echo "INSIDE A HERRE". $username;
        $sql = "SELECT create_id, creations.name, description, object, image FROM `creations`, `kidUsers` 
                WHERE kidUsers.username = creations.username AND creations.username = :username";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * function for deletion of creation
     * @param $id
     */
    function deleteCreation($id){

        $sql = "DELETE FROM creations WHERE create_id = :id";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);
    }

    /**
     * function for resetting of password
     * @param $username
     */
    function resetPassword($username){
        $sql = "UPDATE kidUsers SET passwd = sha1('Password') WHERE username = :username";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        //process results
        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);
    }

    /**
     * function for setting the password
     * @param $username
     * @param $password
     */
    function setPassword($username, $password){
        $sql = "UPDATE kidUsers SET passwd = sha1(:password) WHERE username = :username";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);

        //process results
        $statement->execute();
        //$arr = $statement->errorInfo();
        //print_r($arr);
    }
    /**
     * getting the type of creations
     * @return Array a limited list of types
     */
    function getTypes()
    {
        return array('shapes', 'animals', 'fruits');
    }

    /**
     * type of pictures
     * @return Array of accepatable type of pictures
     */
    function getExtensions(){
        return array('png', 'jpeg', 'jpg');
    }

    /**
     * get the subject for pro user
     * @return string[]
     */
    function getSubjects(){
        return array('math', 'english', 'science', 'history', 'business', 'social studies', 'psychology', 'economics',
            'art', 'theater', 'music', 'language arts', 'home economics');
    }
}

