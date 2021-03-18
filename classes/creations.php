<?php
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->_desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->_desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->_object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->_object = $object;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUsername($userId)
    {
        $this->_userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }
}