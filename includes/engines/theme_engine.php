<?php
/**
 * Date: 05-Feb-18
 * Time: 6:57 PM
 */



function t_content($content="")
{
   if (isset($GLOBALS['content']))
   {
       $GLOBALS['content'] .= $content;
   }
    else
    {
        $GLOBALS['content'] = $content;
    }
}

function print_header()
{

}

function print_content()
{
    if (isset($GLOBALS['content']))
    {
        print($GLOBALS['content']);
    }
    else
    {
        print("No data to display");
    }
}

function print_sidebar()
{

}

function print_footer()
{

}

?>