<?php
class ProUser extends User
{
    private $_subject;
    private $_user_id;

    /**
     * PremiumMember constructor.
     * @param string $subject
     */
    public function __construct($subject="")
    {
        parent::__construct();
        $this->_subject = $subject;
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
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
    }


}