<?php
class proUser extends User
{
    private $_name;
    private $_desc;
    private $_object;
    private $_user_id;
    private $_image;

    /**
     * PremiumMember constructor.
     * @param $_name
     * @param $_desc
     * @param $_object
     * @param $_image
     */
    public function __construct($_name="", $_desc="", $_object="",$_user_id="" ,$_image="")
    {
        parent::__construct();
        $this->_name = $_name;
        $this->_desc = $_desc;
        $this->_object = $_object;
        $this->_object = $_user_id;
        $this->_image = $_image;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->_user_id = $user_id;
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