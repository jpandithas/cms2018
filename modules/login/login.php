<?php
/**
 * Date: 14-Feb-18
 * Time: 8:19 PM
 */

function login()
{
    if (Security::IsLoggedIn())
    {
        t_content("User <b>'{$_SESSION['username']}'</b> already Logged in!");
        return False;
    }

    if (isset($_POST['submit']) and ($_POST['submit'] == 'Login'))
    {

        if (!empty($_POST['username']) and !empty($_POST['password']))
        {
            $username = strip_tags($_POST['username']);
            $password = strip_tags($_POST['password']);

            $db  = new DB();

            $uid  = $db->DBAuthUser($username, $password);

            if ($uid)
            {
                $user  = new User($uid);
                $_SESSION['uid'] = $uid;
                $_SESSION['username'] = $user->GetUsername();
                $_SESSION['userlevel'] = $user->GetUserlevel();
                $url  = new URL();
                $url->Redirect("home");
            }
            else
            {
                $error_msg = "Login Failed!";
            }
        }
        else $error_msg = "Username or Password Empty!";
    }
    if (isset($error_msg))
    {
        t_content($error_msg);
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
    return $form;
}


?>