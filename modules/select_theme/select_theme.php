<?php
/**
 * Date: 12-Feb-18
 * Time: 8:16 PM
 */
function select_theme()
{
   var_dump($_POST);

    $db = new ThemeSwitchDB();

    if (isset($_POST['Submit']) and ($_POST['Submit']=='Apply'))
    {
        t_content("Theme changed!");
        if (!empty($_POST['theme']))
        {
            $db->SetActiveTheme($_POST['theme']);
        } else
        {
            $db->SetActiveTheme();
        }
    }
        $themes = $db->GetThemes();
        t_content(display_form($themes));

}

function display_form($themes)
{
    $form = "<form id='select_theme' class='content_form' action='' method='post'> ";
    $form .="<table id='themes' class='content_table'>";
    $form .="<tr><td>Selection</td><td>Theme Name</td><td>Theme Description</td><td>Status</td></tr>";
    foreach ($themes as $theme)
    {
       // var_dump($theme);
        if ($theme['status'] == 1)
        {
            $status="Active";
            $checked = "checked = 'checked'";
        }
        else
        {
            $status = "Disabled";
            $checked = "";
        }
        $form .= "<tr>";
        $form .= "<td><input type='radio' name='theme' {$checked} value=".$theme['theme_machine_name']. "></td>";
        $form .= "<td>".$theme['theme_display_name']."</td>";
        $form .= "<td>".$theme['theme_desc']."</td>";
        $form .= "<td>{$status}</td>";
        $form .="</tr>";
    }
    $form.="<tr><td colspan='4'><input type='submit' name='Submit' value='Apply'></td></tr>";
    $form.="</table>";
    $form.="</form>";
    return $form;
}

class ThemeSwitchDB extends DB
{
   function GetThemes()
   {
       $dbo = $this->dbo;

       $stmt = $dbo->prepare("SELECT theme_machine_name,theme_display_name,theme_desc,status FROM themes");
       $result = $stmt->execute(array());
       if ($result)
       {
           $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $themes;
       }
       return False;
   }

    public function SetActiveTheme($theme_machine_name='default')
    {
        $dbo = $this->dbo;

        $rows = $dbo->exec("UPDATE `themes` SET `status` = 0");

        $stmt = $dbo->prepare("UPDATE `themes` SET `status` = 1 WHERE `theme_machine_name` = ? LIMIT 1");
        $result = $stmt->execute(array($theme_machine_name));
        if ($result) return True;
    }
}