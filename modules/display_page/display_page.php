<?php
/**
 * Created by PhpStorm.
 * User: jpandithas
 * Date: 19/03/18
 * Time: 19:15
 */

function display_page()
{

    $url = new URL();

    $urlArray = $url->GetUrlComponentArray();

    if (count($urlArray) == 3)
    {
        $id = (integer) $urlArray['id'];
        $alias  = $urlArray['id'];
        $id2str = (string) $id;

        if (strlen($id2str) < strlen($alias))
        {
            //t_content("This is an alias");
            $db = new DisplayQueries();
            $pagedata = $db->GetPageByAlias($alias);
            ShowPage($pagedata);
        }
        else
        {
            //t_content("This is an ID");
            $db = new DisplayQueries();
            $pagedata = $db->GetPageByID($id);
            ShowPage($pagedata);
        }



    }
    else
    {
        t_content("Page not Found!");
    }

}


function ShowPage($page_Array)
{
    if (count($page_Array)==0 or !is_array($page_Array))
    {
        t_content("<h3> Page not found or Page Error!</h3>");
        return False;
    }

    t_content("<h2>{$page_Array['title']}</h2>");
    t_content("{$page_Array['content']}<br><br>");
    t_content("Added on : {$page_Array['timeadd']}<br>");
    t_content("Edited on: {$page_Array['timeedit']}");
    return True;
}

class DisplayQueries extends DB
{

    public function GetPageByID($id)
    {
        if (empty($id)) return False;

        $dbo = $this->dbo;

        $sql= "SELECT title,content,timeadd,timeedit FROM page WHERE pageid = ? LIMIT 1";

        $params = array($id);

        $stmt = $dbo->prepare($sql);
        $result = $stmt->execute($params);

        if ($result)
        {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return False;
        }
    }

    public function GetPageByAlias($alias)
    {
        if (empty($alias)) return False;

        $dbo = $this->dbo;

        $sql= "SELECT title,content,timeadd,timeedit FROM page WHERE alias = ? LIMIT 1";
        $params = array($alias);

        $stmt = $dbo->prepare($sql);
        $result = $stmt->execute($params);

        if ($result)
        {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return False;
        }
    }
}

?>