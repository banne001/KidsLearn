<?php
class ProUser extends User
{
    private $_subject;

    /**
     * PremiumMember constructor.
     * @param string $subject
     */
    public function __construct($_username = "", $_fname = "", $_lname = "", $_age = "", $_grade = "", $_passwd = "", $_isPro = false, $subject="")
    {
        parent::__construct($_username, $_fname, $_lname, $_age, $_grade, $_passwd, $_isPro);
        $this->_subject = $subject;
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