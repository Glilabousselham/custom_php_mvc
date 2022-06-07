<?php

/*
* here we can define the global functions
*/


// this function is used to render the views 
function view($view, $data = [])
{
    $path = "views/" . $view . ".php";
    ob_start();
    extract($data);
    require $path;
    return ob_get_clean();
}
