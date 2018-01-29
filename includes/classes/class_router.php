<?php
/**
 * Date: 24-Jan-18
 * Time: 8:53 PM
 */

class Router
{
    public static function RunModule(URL $url)
    {
        $db  = new DB();
        $mod_name = $db->GetModuleFromDB($url);
        $file_path = 'modules/'.$mod_name.'/'.$mod_name.".php";
        if (is_readable($file_path))
        {
            require_once($file_path);
            if (is_callable($mod_name,True))
            {
                call_user_func($mod_name);
                return True;
            }
        }
        return False;
    }
}

?>