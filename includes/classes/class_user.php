<?php
/**
 * Date: 14-Feb-18
 * Time: 8:51 PM
 */

class User
{
    protected $uid;
    protected $username;
    protected $userlevel;

    public function __construct($uid)
    {
        $this->GetUserFromID($uid);
    }

    protected  function GetUserFromID($uid)
    {
        $db =  new DB();
        $user = $db->GetUserDataFromID($uid);
        if ($user)
        {
            $this->uid = $uid;
            $this->username = $user['username'];
            $this->userlevel = $user['userlevel'];
        }
        return False;
    }

    public Function GetUsername()
    {
        return $this->username;
    }

    public function GetUserlevel()
    {
        return $this->userlevel;
    }
}

?>