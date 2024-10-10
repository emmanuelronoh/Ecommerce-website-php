<?php
session_start();

function redirect($url)
{
    header("Location: $url");
    exit();
}

function escape($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}