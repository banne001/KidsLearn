<?php
class User{
    private $_username;
    private $_fname;
    private $_lname;
    private $_age;
    private $_grade;
    private $_password;
    private $_isPro;

    /**
     * User constructor.
     * @param $_username
     * @param $_fname
     * @param $_lname
     * @param $_age
     * @param $_grade
     * @param $_password
     * @param $_isPro
     */
    public function __construct($_username, $_fname, $_lname, $_age, $_grade, $_password, $_isPro)
    {
        $this->_username = $_username;
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_grade = $_grade;
        $this->_password = $_password;
        $this->_isPro = $_isPro;
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

    /**
     * @param mixed $isPro
     */
    public function setIsPro($isPro)
    {
        $this->_isPro = $isPro;
    }



}