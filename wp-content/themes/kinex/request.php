<?php
/*
Template Name: templatenamesa
*/


function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

Redirect('http://tebmart.com/sell-books/', false);

?>