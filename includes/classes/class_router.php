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

        if (Security::IsModAllowedToRun($url)== False)
        {
            t_content("<h3 class='error' id='level'>Insufficient User Level</h3>");
            return False;
        }

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