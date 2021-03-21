<?php
/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website - validation.php
 * Version 1.0
 * validation class for validating data for sign in and other routes
 **/
class Validation {
    private $_dataLayer;

    /**
     * Validation constructor.
     * @param $dataLayer
     */
    public function __construct($dataLayer)
    {
        $this->_dataLayer = $dataLayer;
    }

    /**
     * validUsername() returns true if username is not empty and no spaces
     * @param $user
     * @return bool
     */
    function validName($user){
        return !empty($user) && ctype_alpha($user);
    }

    /**
     * validation of username
     * @param $user
     * @return false|int
     */
    function validUsername($user){
        return preg_match("/^[\S]+$/", $user);
    }

    /**
     * validPassword() returns true password is valid
     * @param $password
     * @return bool
     */
    function validPassword($password)
    {
        return strlen($password) >= 8;
    }

    /**
     * validAge() returns the age is numeric and less than 118
     * @param $age
     * @return bool
     */
    function validAge($age){
        return is_numeric($age) && $age <=118;
    }

    /**
     * validAge() returns the age is numeric and less than 118
     * @param $grade
     * @return bool
     */
    function validGrade($grade){
        return is_numeric($grade) && $grade <=12;
    }

    /**
     * validation of subject
     * @param $subject
     * @return bool
     */
    function validSubject($subject){
        return in_array(strtolower($subject), $this->_dataLayer->getSubjects());
    }

    /**
     * validation of extension of pictures
     * @param $ext
     * @return bool
     */
    function validExtension($ext)
    {
        return in_array($ext, $this->_dataLayer->getExtensions());
    }

    /**
     * Validation of type of creation
     * @param $type
     * @return bool
     */
    function validType($type){
        return in_array($type, $this->_dataLayer->getTypes());
    }
}
