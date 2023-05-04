<?php
function debug($var)
{
    echo '<div style="background: #ccc; border: 1px solid black; padding: 5px 20px">';
    echo '<h2>DEBUG</h2><hr>';
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    echo '</div>';
}

function debugWithExit($var)
{
    debug($var);
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);