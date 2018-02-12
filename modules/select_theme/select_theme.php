<?php
/**
 * Date: 12-Feb-18
 * Time: 8:16 PM
 */
function select_theme()
{
    $db = new ThemeSwitchDB();
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
        var_dump($theme);
        $form .= "<tr>";
        $form .= "<td><input type='radio' name='theme' value=".$theme['theme_machine_name']. "></td>";
        $form .= "<td>".$theme['theme_display_name']."</td>";
        $form .= "<td>".$theme['theme_desc']."</td>";
        $status = "Disabled";
        if ($theme['status'] == 1) {$status="Active";}
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
}