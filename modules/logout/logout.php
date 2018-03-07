<?php
/**
 * Date: 14-Feb-18
 * Time: 8:20 PM
 */

function logout()
{
    session_destroy();
    $url = new URL();
    $url->Redirect("home");
}

?>