<?php
/* model/validate.php
 * Contains validation functions for Sign Up
 *
 */
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
    //still work on this
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
    return in_array($type, getTypes());
}
function validExtension($ext)
{

    return in_array($ext, getExtensions());
}

function validType($type){
    return in_array($type, getTypes());
}