<?php
/**
 * Date: 05-Feb-18
 * Time: 8:25 PM
 */

class Theme
{
    static $content;

    public static function GetActiveTheme()
    {
        $db = new DB();
        $theme = $db->GetActiveTheme();
        $theme_path = "themes/".$theme;
        if (is_dir($theme_path))
        {
            if (is_readable($theme_path."/theme.html"))
            {
                include_once($theme_path."/theme.html");
            }
        }
        else
        {
            include("themes/default/theme.html");
        }
    }

}