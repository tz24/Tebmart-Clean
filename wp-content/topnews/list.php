<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'conf.php';
$lines = file('topnews.txt');
if ($_GET['p'] == 'bb') {
$type = 'bb';
} elseif ($_GET['p'] == 'kr') {
$type = 'kr';
} elseif ($_GET['p'] == 'html') {
$type = 'html';
} elseif ($_GET['p'] == 'txt') {
$type = 'txt';
} else {
echo '<a href="list.php?p=bb">BBCode</a> <a href="list.php?p=kr">Crossposting</a> <a href="list.php?p=html">HTML</a> <a href="list.php?p=txt">TXT</a>';
die();
}
foreach ($lines as $line) 
{
$line = trim($line);
$line = mb_strtolower($line, 'utf-8');
$line = str_ireplace('%', '', $line);
$line = str_ireplace('?', '', $line);
$line = str_ireplace('.', ' ', $line);
$line = str_ireplace('/', '', $line);
$line = str_ireplace(':', '', $line);
$line = str_ireplace('_', '', $line);
$line = str_ireplace(',', '', $line);
$line = str_ireplace('!', '', $line);
$line = str_ireplace(' ', '-', $line);
$line = str_ireplace('--', '-', $line);
$line2 = str_ireplace('-', ' ', $line);
if ($type == 'bb') {
echo '[url=http://'.$_SERVER['HTTP_HOST'].$dir.urlencode(mb_strtolower($line, 'utf-8')).'/]'.$line2.'[/url]<br>';
} elseif ($type == 'kr') {
echo ''.$line2.'|http://'.$_SERVER['HTTP_HOST'].$dir.urlencode(mb_strtolower($line, 'utf-8')).'/<br>';
} elseif ($type == 'html') {
echo '&lt;a href="http://'.$_SERVER['HTTP_HOST'].$dir.urlencode(mb_strtolower($line, 'utf-8')).'/"&gt;'.$line2.'&lt;/a&gt;<br>';
} elseif ($type == 'txt') {
echo 'http://'.$_SERVER['HTTP_HOST'].$dir.urlencode(mb_strtolower($line, 'utf-8')).'/<br>';
} else {}
}
