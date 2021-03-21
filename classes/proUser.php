<?php
/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website - proUser.php
 * Version 1.0
 * proUser class for setter and getter of proUser class
 **/
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


    /**Getting the subject of proUser member
     * @return mixed subject of Pro User likes
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**Setting the subject pro user like
     * @param mixed $subject subject of Pro User likes
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
    }


}