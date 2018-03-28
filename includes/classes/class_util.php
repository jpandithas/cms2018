<?php
/**
 * Created by PhpStorm.
 * User: jpandithas
 * Date: 28/03/18
 * Time: 18:13
 */
class Utilities
{

    public static function Confirm_Form($msgtext)
    {
        $html  = "<form class='yes_no_form' method='post' action='' > ";
        $html .= "<h3>{$msgtext}</h3>";
        $html .= "<input class='yes_btn' type='submit' name='Yes' value='Yes'>" ;
        $html .= "<input class='no_btn' type='submit' name='No' value='No'>";
        $html .= "</form>";
        return $html;
    }

    public static function GetPageFromURL()
    {
        $url = new URL();

        $urlArray = $url->GetUrlComponentArray();

        if (count($urlArray) == 3)
        {
            $id = (integer) $urlArray['id'];
            $alias  = $urlArray['id'];
            $id2str = (string) $id;

            $db  = new DB();

            if (strlen($id2str) < strlen($alias))
            {
                //t_content("This is an alias");
                $pagedata = $db->GetPageByAlias($alias);
            }
            else
            {
                //t_content("This is an ID");
                $pagedata = $db->GetPageByID($id);
            }

            if (is_array($pagedata)) return $pagedata;
        }
        else
        {
            return False;
        }
        return False;
    }

}

?>