<?php
header('Content-Type: text/xml; charset=UTF-8');
require_once 'conf.php';
$host = preg_replace("/[^0-9A-Za-z-.]/","",trim($_SERVER['HTTP_HOST']));
if ($keysource == '1')
{
$lines = @file('sitemap.txt');
}
else
{
$lines = @file('topnews.txt');
}
$lines = array_unique($lines);
$countpage = count($lines);
if ($countpage > $maxpage AND @$stoppage != '1')
{
file_put_contents('conf.php', "\n\$stoppage = '1';\n", FILE_APPEND | LOCK_EX);
}
shuffle($lines);
$lines = array_slice($lines, 0, 25);
echo '<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
<channel>
<title>'.$host.'</title>
<link>https://'.$host.$dir.'</link>
<atom:link href="http://'.$host.$dir.'rss.php" rel="self" type="application/rss+xml" />
<description></description>
<language>'.$lang.'</language>';
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
echo '<item>
   <title>'.$line2.'</title>
   <link>http://'.$host.$dir.urlencode($line).'/</link>
   <guid>http://'.$host.$dir.urlencode($line).'/</guid> 
</item>';
}
echo '</channel></rss>';
