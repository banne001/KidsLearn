<?php
class User{
    private $_userId;
    private $_username;
    private $_fname;
    private $_lname;
    private $_age;
    private $_grade;
    private $_passwd;
    private $_isPro;

    /**
     * User constructor.
     * @param $_username
     * @param $_fname
     * @param $_lname
     * @param $_age
     * @param $_grade
     * @param $_passwd
     * @param $_isPro
     */
    public function __construct($userId = "", $_username = "", $_fname = "", $_lname = "", $_age = "", $_grade = "", $_passwd = "", $_isPro = false)
    {
        $this->_userId = $userId;
        $this->_username = $_username;
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_grade = $_grade;
        $this->_passwd = $_passwd;
        $this->_isPro = $_isPro;
    }

    /**
     * @param mixed|string $passwd
     */
    public function setPasswd($passwd)
    {
        $this->_passwd = $passwd;
    }

    /**
     * @return mixed|string
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @param mixed|string $userId
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }



    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return mixed
     */
    public function getGrade()
    {
        return $this->_grade;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade)
    {
        $this->_grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getIsPro()
    {
        return $this->_isPro;
    }
    public function getPasswd()
    {
        return $this->_passwd;
    }

    /**
     * @param mixed $isPro
     */
    public function setIsPro($isPro)
    {
        $this->_isPro = $isPro;
    }



}