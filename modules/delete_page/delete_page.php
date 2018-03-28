<?php
/**
 * Created by PhpStorm.
 * User: jpandithas
 * Date: 28/03/18
 * Time: 18:05
 */

function delete_page()
{
    t_content("<h2>Delete Page</h2>");

    $db = new DeletePageQueries();
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
            $pagedata = $db->GetPageByAlias($alias);
        }
        else
        {
            //t_content("This is an ID");
            $pagedata = $db->GetPageByID($id);
        }

        $pageid= $pagedata['pageid'];

        if (isset($_POST) and (isset($_POST['Yes']) or isset($_POST['No'])))
        {
            if ($_POST['Yes'] == 'Yes')
            {
                $db->DeletePage($pageid);
                t_content("Page Deleted Successfully!");
                return True;
            }
            elseif ($_POST['No'] == 'No')
            {
                $url->Redirect("display/page/{$pageid}");
            }
        }

        $text = "Do you wish to delete the page <em>'{$pagedata['title']}'</em> ?";
        t_content(Utilities::Confirm_Form($text));
    }
    else
    {
        t_content("Page not Found!");
    }
}


class DeletePageQueries extends DB
{


    public function DeletePage($id)
    {
        $dbo = $this->dbo;

        $sql  = "DELETE FROM page WHERE pageid = ? LIMIT 1";
        $params = array($id);

        $stmt = $dbo->prepare($sql);
        $result  = $stmt->execute($params);

        if ($result)
        {
            return True;
        }
        return False;
    }
}

?>