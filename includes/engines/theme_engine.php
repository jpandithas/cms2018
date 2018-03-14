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

function t_sidebar($sidebar="")
{
    if (isset($GLOBALS['sidebar']))
    {
        $GLOBALS['sidebar'] .= $sidebar;
    }
    else
    {
        $GLOBALS['sidebar'] = $sidebar;
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
    if (isset($GLOBALS['sidebar']))
    {
        print($GLOBALS['sidebar']);
        return True;
    }
    return False;
}

function print_footer()
{

}

?>