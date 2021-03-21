<?php
/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website - user.php
 * Version 1.0
 * user class for setter and getter of sign up
 **/
class User{
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
    public function __construct( $_username = "", $_fname = "", $_lname = "", $_age = "", $_grade = "", $_passwd = "", $_isPro = false)
    {
        $this->_username = $_username;
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_grade = $_grade;
        $this->_passwd = $_passwd;
        $this->_isPro = $_isPro;
    }

    /**Setting the password for user
     * @param mixed|string $passwd
     */
    public function setPasswd($passwd)
    {
        $this->_passwd = $passwd;
    }

    /**Getting the username of user
     * @return mixed username of user
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**Setting the username of user class
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**Getting the first name of user
     * @return mixed first name of user
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**Setting the first name of user
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**Getting the last name of user
     * @return mixed last name of user
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**Setting the last name of user
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**Getting the age of user
     * @return mixed age of user
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**Setting the age of user
     * @param mixed $age of user
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /** Getting the grade of user
     * @return mixed grade of user
     */
    public function getGrade()
    {
        return $this->_grade;
    }

    /** Setting the Grade of user
     * @param mixed $grade of user
     */
    public function setGrade($grade)
    {
        $this->_grade = $grade;
    }

    /** Getting the user, to check for proUser
     * @return mixed boolean of proUser checkbox
     */
    public function getIsPro()
    {
        return $this->_isPro;
    }

    /** Getting the password for user
     * @return mixed|string for user
     */
    public function getPasswd()
    {
        return $this->_passwd;
    }

    /**Setting if the user wanted the proUser account
     * @param mixed $isPro boolean value
     */
    public function setIsPro($isPro)
    {
        $this->_isPro = $isPro;
    }

}