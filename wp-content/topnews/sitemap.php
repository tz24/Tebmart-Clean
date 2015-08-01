<?php
header('Content-Type: text/xml; charset=UTF-8');
require_once 'conf.php';
if ($keysource == '1') {
$lines = @file('sitemap.txt');
} else {
$lines = @file('topnews.txt');
}
$lines = array_unique($lines);
$countpage = count($lines);
if ($countpage > $maxpage AND @$stoppage != '1') {
file_put_contents('conf.php', "\n\$stoppage = '1';\n", FILE_APPEND | LOCK_EX);
}
echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';
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
echo '<url>
   <loc>http://'.$_SERVER['HTTP_HOST'].$dir.urlencode($line).'/</loc>
   <changefreq>weekly</changefreq>
   <priority>1.0</priority>
</url>';
}
echo '</urlset>';
