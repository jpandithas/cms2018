<?php
/**
 * Date: 05-Mar-18
 * Time: 8:13 PM
 */

class Security
{
    public static function IsLoggedIn()
    {
        if (isset($_SESSION['uid'])) // you can add the username and userlevel
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function CMS_Hash($data)
    {
        if (empty($data)) return False; //one line statement does not need {}

        return md5(HASH_SALT.md5($data));
    }
}