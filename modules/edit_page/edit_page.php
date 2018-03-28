<?php
/**
 * Created by PhpStorm.
 * User: jpandithas
 * Date: 26/03/18
 * Time: 18:10
 */

function edit_page()
{
    t_content("<h2>Edit Page</h2>");

    $db = new EditQueries();

    $pagedata = Utilities::GetPageFromURL();

    if (!is_array($pagedata))
    {
        t_content("<h3> Page not Found! </h3>");
        return False;
    }

    if (isset($_POST['edit_page']) and ($_POST['edit_page'] == "Edit Page") )
    {

        if ($db->isDuplicateAlias($_POST['alias'],$_POST['pageid']))
        {
            t_content("<h3 class='error'>Alias Exists</h3>");
        }
        else
        {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $alias = $_POST['alias'];
            $pageid = $_POST['pageid'];
            if ($db->EditPage($title,$content,$alias,$pageid))
            {
                t_content("Page Edited Successfully");
            }
            else
            {
                t_content("Edit Operation Failed");
            }
        }
    }

    t_content(ShowEditPageForm($pagedata));
}

function ShowEditPageForm($pagedata)
{
    $title = $pagedata['title'];
    $content = $pagedata['content'];
    $alias = $pagedata['alias'];
    $pageid = $pagedata['pageid'];

    $html  = "<form id='edit_page' method='post' action=''>";
    $html .="<table>";
    $html .= "<tr><td>TITLE</td><td><input type='text' name='title' value='{$title}' required='required'><td></tr>";
    $html .= "<tr><td>CONTENT</td><td><textarea  id='text_editor' required='required' name='content'>{$content}</textarea><td></tr>";
    $html .= "<tr><td>ALIAS</td><td><input type='text' name='alias' value='{$alias}' required='required'><td></tr>";
    $html .= "<input type='hidden' name='pageid' value={$pageid} >";
    $html .= "<tr><td rowspan='2'><input type='submit' name='edit_page' value='Edit Page'></td>";
    $html .= "<td rowspan='2'><a href=".CMS_BASE_URI."?q=display/page/{$pageid} class='cms-btn'>View Page</a></td></tr>";
    $html .= "<table>";
    $html .= "</form>";
    $html .="<br/> ";

    return $html;
}

class EditQueries extends DB
{
    public function isDuplicateAlias($alias, $pageid)
    {
        if (empty($alias)) return False;

        $dbo = $this->dbo;
        $sql =  "SELECT pageid FROM page where alias = ? AND (pageid != ?) LIMIT 1";
        $stmt = $dbo->prepare($sql);
        $params = array($alias,$pageid);
        $result = $stmt->execute($params);

        return $stmt->fetch();
    }


    public function EditPage($title,$content,$alias,$pageid)
    {
        if (empty($title) or empty($content) or empty($alias) or empty($pageid)) return False;

        $dbo =  $this->dbo;//new PDO();

        $sql = "UPDATE page SET title = ? , content = ? , alias = ? , timeedit = now() WHERE pageid = ? LIMIT 1";


        $stmt = $dbo->prepare($sql);

        $params = Array($title,$content,$alias,$pageid);
       // var_dump($params);

        $result = $stmt->execute($params);

       // var_dump($stmt->errorInfo());  //We can get the SQL Error MSG

        if ($result) return True;
        return False;

    }

}

?>