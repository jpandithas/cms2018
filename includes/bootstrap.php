<?php
/**
 * Date: 29-Jan-18
 * Time: 8:29 PM
 */

function boot($debug=False)
{
    include("settings/settings.php");

    LoadFile("includes/*/*",$debug);

    $url = new URL();

    Router::RunModule($url);

    if (Security::IsLoggedIn())
    {
        echo "User: ".$_SESSION['username']." is online";
    }

    t_sidebar(Theme::RenderMainNavMenu());

    ob_start();
    Theme::GetActiveTheme();
    ob_end_flush();  // NO CODE BELOW THIS LINE
}

function LoadFile($path,$debug=True)
{
    if (empty($path)) return False;

    $includes_file_array = glob($path);

    if ($debug==True) {
        echo "DEBUG: includes variable";
        var_dump($includes_file_array);
    }

    foreach ($includes_file_array as $filepath)
    {
        if (is_readable($filepath) and !(is_uploaded_file($filepath)))
        {
            include_once($filepath);
            if ($debug==True) print("Debug: ".$filepath." -- Loaded -- <br/>");

        }
    }
    return True;
}

?>