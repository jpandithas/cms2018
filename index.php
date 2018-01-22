<?php
/**
 * Date: 17-Jan-18
 * Time: 7:04 PM
 */

include('includes/classes/class_url.php');

var_dump($_GET);

$url = new URL();

var_dump($url->GetUrlComponentArray());


?>



