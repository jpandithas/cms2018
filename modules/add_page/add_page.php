<?php
/**
 * Date: 24-Jan-18
 * Time: 8:45 PM
 */

function add_page()
{

    t_content("<h2> Add Page</h2>");

    if (isset($_POST['add_page']) and $_POST['add_page']== "Add Page")
    {
        $db = new Add_Page_Queries();

        if ($db->isDuplicateAlias($_POST['alias']))
        {
            t_content("Alias: <b><i>{$_POST['alias']}</i></b> exists!<br/>");
            t_content(show_add_page_form($_POST['title'],$_POST['content'],$_POST['alias']));
            return True;
        }

        $result = $db->AddPage($_POST['title'],$_POST['content'],$_POST['alias']);
        if ($result)
        {
            t_content("Page Added!</br>");

            $url = new URL();
            $url->Redirect("display/page/{$_POST['alias']}");
        }
        else
        {
            t_content("The form contains errors!<br/>");
            t_content(show_add_page_form($_POST['title'],$_POST['content'],$_POST['alias']));
            return True;
        }
    }
    t_content(show_add_page_form("title","Content goes here","alias"));

   // xdebug_print_function_stack();
}

function show_add_page_form($title,$content,$alias)
{
    $html  = "<form id='add_page' method='post' action=''>";
    $html .="<table>";
    $html .= "<tr><td>TITLE</td><td><input type='text' name='title' value='{$title}' required='required'><td></tr>";
    $html .= "<tr><td>CONTENT</td><td><textarea required='required' name='content'>{$content}</textarea><td></tr>";
    $html .= "<tr><td>ALIAS</td><td><input type='text' name='alias' value='{$alias}' required='required'><td></tr>";
    $html .= "<tr><td><input type='submit' name='add_page' value='Add Page'></td></tr>";
    $html .= "<table>";
    $html .= "</form>";

    return $html;
}

class Add_Page_Queries extends DB
{
    public function isDuplicateAlias($alias)
    {
        if (empty($alias)) return False;

        $dbo = $this->dbo;
        $sql =  "SELECT alias FROM page where alias = ? LIMIT 1";
        $stmt = $dbo->prepare($sql);
        $params = array($alias);
        $result = $stmt->execute($params);

        return $stmt->fetch();
    }

    public function AddPage($title, $content, $alias)
    {
        if (empty($title) or empty($content) or empty($alias)) return False;

        $dbo = $this->dbo;
        $sql = "INSERT INTO page VALUES (NULL,?,?,?,now(),now())";
        $stmt = $dbo->prepare($sql);
        $params = array($title, $content, $alias);
        $result = $stmt->execute($params);

        if ($result)
        {
            return $dbo->lastInsertId();
        }
        return False;
    }
}

?>