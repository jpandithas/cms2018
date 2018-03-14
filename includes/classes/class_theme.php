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
                return True;
            }
        }

            include("themes/default/theme.html");
    }

    public static function RenderMainNavMenu()
    {
        $db = new DB();
        $items = $db->GetSidebarItems();

        $html = "<ul id='main-nav' class='nav'>";

        foreach ($items as $item)
        {
            if ((Security::IsLoggedIn()== True) and ($item['action']=='login')) continue;
            if ((Security::IsLoggedIn()== False) and ($item['action']=='logout')) continue;

            $html .= "<li class='nav-item'>";
            $html.= "<a class='nav-link' href='".CMS_BASE_URI."?q=".$item['action'];
            if ($item['type']!=null)
            {
                $html.="/".$item['type'];
            }
            $html.="'>".$item['mod_real_name']."</a>";
        }

        $html.="</ul>";

        return $html;
    }

}