<?php
/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website - creations.php
 * Version 1.0
 * creation class for setter and getter of
 * name, type, desc, username and image
**/
class Creations
{
    private $_name;
    private $_desc;
    private $_object;
    private $_username;
    private $_image;

    /**
     * Creations constructor.
     * @param $_name
     * @param $_desc
     * @param $_object
     * @param $_username
     * @param $_image
     */
    public function __construct($_name="", $_desc="", $_object="", $_username="", $_image="")
    {
        $this->_name = $_name;
        $this->_desc = $_desc;
        $this->_object = $_object;
        $this->_username = $_username;
        $this->_image = $_image;
    }

    /** Getting the name of user's creation
     * @return mixed name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**Setting the name of user's creation
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /** Getting the description of user's creation
     * @return mixed description of creation
     */
    public function getDesc()
    {
        return $this->_desc;
    }

    /**Setting the description, user provided
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->_desc = $desc;
    }

    /** Getting the type of user's creation
     * @return mixed type of object, user's creation
     */
    public function getObject()
    {
        return $this->_object;
    }

    /**Setting the type of object user draw
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->_object = $object;
    }

    /** Getting the username of user's creation
     * @return mixed username
     */
    public function getUsername()
    {
        return $this->_userId;
    }

    /**Setting userId's creation
     * @param mixed $userId
     */
    public function setUsername($userId)
    {
        $this->_userId = $userId;
    }

    /** Getting the image of user's creation
     * @return mixed the image
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**Setting the image of user's creation
     * @param mixed $image of user's creaion
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }
}