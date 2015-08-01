<?php
require_once 'conf.php';
header('Content-Type: text/plain');
$host = preg_replace("/[^0-9A-Za-z-.]/","",trim($_SERVER['HTTP_HOST']));
echo 'User-Agent: *
Disallow: /*.txt
Disallow: /css/*
Disallow: /style/*
Disallow: /images/*
Disallow: /install.php
Disallow: /wp-login.php
Sitemap: http://'.$host.$dir.'sitemap.xml';
$xmlping = '<?xml version="1.0" encoding="UTF-8"?>
<methodCall>
    <methodName>weblogUpdates.ping</methodName>
    <params>
        <param>
            <value>'.$host.'</value>
        </param>
        <param>
            <value>http://'.$host.$dir.'rss.php</value>
        </param>
    </params>
</methodCall>';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ping.blogs.yandex.ru/RPC2');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . mb_strlen($xmlping), 'Content-type: text/xml')); 
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlping);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
$outch = curl_exec($ch);
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://blogsearch.google.com/ping/RPC2');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . mb_strlen($xmlping), 'Content-type: text/xml')); 
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlping);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
$outch = curl_exec($ch);
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.google.com/webmasters/sitemaps/ping?sitemap=http://'.$host.$dir.'sitemap.php');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
$outch = curl_exec($ch);
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.bing.com/webmaster/ping.aspx?sitemap=http://'.$host.$dir.'sitemap.php');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
$outch = curl_exec($ch);
curl_close($ch);
