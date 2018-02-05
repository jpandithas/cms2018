<?php
/**
 * Date: 05-Feb-18
 * Time: 6:57 PM
 */



function t_content($content)
{
   Theme::$content = $content;
}

function print_header()
{

}

function print_content()
{
   print(Theme::$content);
}

function print_sidebar()
{

}

function print_footer()
{

}

?>