<?php
/**
 * Date: 14-Feb-18
 * Time: 8:19 PM
 */

function login()
{
    var_dump($_POST);

    if (isset($_POST['submit']) and ($_POST['submit'] == 'Login'))
    {
        t_content("Logged");
    }
    t_content(login_form());
}

function login_form()
{
    $form  = "<form name='login' id='login-form' action='' method='post'>";
    $form .= "<table>";
    $form .= "<tr> <td> Username </td><td><input type='text' name='username' required='required'></td></tr>";
    $form .= "<tr> <td> Password </td><td><input type='password' name='password' required='required'></td></tr>";
    $form .= "<tr><td colspan='2'><input type='submit' name='submit' value='Login'></td></tr>";
    $form .= "</table>";
    $form .= "</form>";
}

?>