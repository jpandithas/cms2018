<?php
/**
 * Date: 17-Jan-18
 * Time: 7:04 PM
 */

include('settings/settings.php');
include('includes/classes/class_url.php');
include('includes/classes/class_db.php');

var_dump($_GET);

$url = new URL();

var_dump($url->GetUrlComponentArray());

$db = new DB();

if ($db->testDB())
{
    echo "DB Success";
}
else
{
    echo "Not Connected";
}


?>



