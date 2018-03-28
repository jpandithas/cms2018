<?php
/**
 * Created by PhpStorm.
 * User: jpandithas
 * Date: 19/03/18
 * Time: 19:15
 */

function display_page()
{

    $pagedata = Utilities::GetPageFromURL();

    if (is_array($pagedata))
    {
        t_content(DisplayButtons($pagedata));
        ShowPage($pagedata);
    }
    else
    {
        t_content("<h3> Page Not Found</h3>");
    }

}

function DisplayButtons($pagedata)
{

    if (Security::IsLoggedIn()== False ) return False;

    $html  = "<a class='cms-btn' href=".CMS_BASE_URI."?q=edit/page/".$pagedata['pageid']."> Edit Page </a>";
    $html .= "<a class='cms-btn' id='delete-btn' href=".CMS_BASE_URI."?q=delete/page/".$pagedata['pageid']."> Delete Page </a>";
    return $html;
}

function ShowPage($page_Array)
{
    if (count($page_Array)==0 or !is_array($page_Array))
    {
        t_content("<h3> Page Error!</h3>");
        return False;
    }

    t_content("<h2>{$page_Array['title']}</h2>");
    t_content("{$page_Array['content']}<br><br>");
    t_content("Added on : {$page_Array['timeadd']}<br>");
    t_content("Edited on: {$page_Array['timeedit']}");
    return True;
}


?>