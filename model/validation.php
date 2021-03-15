<?php
/* model/validate.php
 * Contains validation functions for Sign Up
 *
 */
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
     * Used for username, first and last name
     */
    function validName($user){
        return !empty($user) && ctype_alpha($user);
    }

    /** validPassword() returns true password is valid */
    function validPassword($password)
    {
        //TODO: do we need a requirement...?
        return true;
    }

    /** validAge() returns the age is numeric and less than 118 */
    function validAge($age){
        return is_numeric($age) && $age <=118;
    }
    /** validAge() returns the age is numeric and less than 118 */
    function validGrade($grade){
        return is_numeric($grade) && $grade <=12;
    }
    function validObject($type){
        return in_array($type, $this->_dataLayer->getTypes());
    }
    function validExtension($ext)
    {

        return in_array($ext, $this->_dataLayer->getExtensions());
    }

    function validType($type){
        return in_array($type, $this->_dataLayer->getTypes());
    }
}
