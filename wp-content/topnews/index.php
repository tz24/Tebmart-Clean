<?php
error_reporting(0);
ini_set('display_errors', 'off');
ini_set('error_log',NULL);
ini_set('log_errors',0);
ini_set('max_execution_time',0);
set_time_limit(0);
header('Content-Type: text/html; charset=UTF-8');
require_once 'conf.php';
$host = preg_replace("/[^0-9A-Za-z-.]/","",trim($_SERVER['HTTP_HOST']));
$content = '';
$indexkeys = '';
if ($_SERVER['REQUEST_URI'] == $dir OR $_SERVER['REQUEST_URI'] == $dir.'/index.php') {
$keys = file('host.txt');
$key = @trim($keys[0]);
if ($key == '') {die('Page Not Found');}
if ($keysource == '1') {
$indexkeys.= '<p>';
foreach ($keys as $line) {
$line = trim($line);
$indexkeys.= '<a href="'.$dir.urlencode($line).'/">'.$line.'</a>, ';
}
$indexkeys.= '</p>';
}
} else {
preg_match('!'.$dir.'(.*?)\/!siu', trim($_SERVER['REQUEST_URI']), $key);
$key = @trim(strip_tags(urldecode($key[1])));
}
if ($key == '') {
header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$dir);
die();
} else {
$newkey = mb_strtolower($key, 'utf-8');
$newkey = str_ireplace('%', '', $newkey);
$newkey = str_ireplace('?', '', $newkey);
$newkey = str_ireplace('.', ' ', $newkey);
$newkey = str_ireplace('/', '', $newkey);
$newkey = str_ireplace(':', '', $newkey);
$newkey = str_ireplace('_', '', $newkey);
$newkey = str_ireplace(',', '', $newkey);
$newkey = str_ireplace('!', '', $newkey);
$newkey = str_ireplace(' ', '-', $newkey);
$newkey = str_ireplace('--', '-', $newkey);
$blackkeys1 = array('%', '?', '.', '/', ':', '_', ',', '!');
if ($newkey != $key AND $_SERVER['REQUEST_URI'] != $dir) {
header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$dir.urlencode($newkey).'/');
die();
}
$key = str_ireplace('-', ' ', $key);
if (file_exists('page/'.mb_substr(md5($key), 1, 4, 'utf-8').'/'.md5($key).'.txt')) {
$xml = simplexml_load_file('page/'.mb_substr(md5($key), 1, 4, 'utf-8').'/'.md5($key).'.txt'); 
$key = trim($xml->key);
$content = trim($xml->content);
$link = trim($xml->link);
$fotos = trim($xml->foto);
} else {
if (@$stoppage == '1') {
header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$dir.'#error');
die();
}
$titlestr = mb_strtolower($key, 'utf-8');
$blackkeys = file('errors.txt');
foreach ($blackkeys as $blackkey) {
$blackkey = trim($blackkey);
$keyfind = strripos($titlestr, $blackkey);
if ($keyfind !== false){
header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$dir.'#error');
die();
}
}
$keys = array();
if ($keysource == '1') {
if ($lang == 'ru') {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://suggests.go.mail.ru/ie8?q='.urlencode($key));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
preg_match_all('!\<Text\>(.*?)\</Text\>!siu', $outch, $lines);
foreach ($lines[1] as $line) {
$line = trim($line);
$keys[md5($line)] = $line;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://suggest.yandex.ru/suggest-ff.cgi?part='.urlencode($key).'&uil=ru&sn=20');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
$lines = @(array)json_decode($outch);
foreach ($lines[1] as $line) {
$line = trim($line);
$keys[md5($line)] = $line;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://autocomplete.nigma.ru/complete/query_help.php?suggest=true&q='.urlencode($key));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
$lines = @(array)json_decode($outch);
foreach ($lines[1] as $line) {
$line = trim($line);
$keys[md5($line)] = $line;
}
} else {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://search.yahoo.com/sugg/gossip/gossip-us-fp/?nresults=20&command='.urlencode($key));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
$outch = str_ireplace('fxsearch(', '', $outch);
$outch = str_ireplace('],[],[]])', ']]', $outch);
$lines = @(array)json_decode($outch);
foreach ($lines[1] as $line) {
$line = trim($line);
$keys[md5($line)] = $line;
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://clients1.google.com/s?hl='.$lang.'&client=opera&q='.urlencode($key));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
$lines = @(array)json_decode($outch);
foreach ($lines[1] as $line) {
$line = trim($line);
$keys[md5($line)] = $line;
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://ss.ask.com/query?li=ff&sstype=prefix&num=20&q='.urlencode($key));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
$lines = @(array)json_decode($outch);
foreach ($lines[1] as $line) {
$line = trim($line);
$keys[md5($line)] = $line;
}
}
} else {
$keys = file('topnews.txt');
shuffle($keys);
$keys = array_slice($keys, 0, $keycount);
}
$link = '<ul>';
shuffle($keys);
foreach ($keys as $line) {
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
foreach ($blackkeys1 as $blackkey) {
$blackkey = trim($blackkey);
$keyfind = strripos($line, $blackkey);
if ($keyfind !== false){
$line = '';
}
}
$line2 = str_ireplace('-', ' ', $line);
if ($_SERVER['REQUEST_URI'] != $dir.urlencode($line).'/' AND $line != '') {
$link.= '<li><a href="'.$dir.urlencode($line).'/">'.$line2.'</a></li>';
}
}
$link.= '</ul>';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.bing.com/search?format=rss&q='.urlencode($key));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$outch = curl_exec($ch);
curl_close($ch);
if ($contentsource == '1') {
preg_match_all('!\<description\>(.*?)\</description\>!siu', $outch, $lines);
unset($lines[1][0]);
shuffle($lines[1]);
$content.= '<p>';
foreach ($lines[1] as $line) 
{
$content.= trim($line).' ';
}
$content.= '.</p>';
$badchar = array ("\n","\r","\t",'&nbsp;','&laquo;','&raquo;','&quot;','&#8592;','&#8594;','&#39;','&#8211;','&#32;','&#160;','&#8212;','&#8230;','&#039;','&rarr;','&mdash;','&gt;','&lt;','{','}','#','"');
$content = str_ireplace($badchar, ' ', $content);
$content = str_ireplace('...', '.', $content);
$content = str_ireplace(' .', '.', $content);
$content = str_ireplace('..', '.', $content);
$content = str_ireplace(',.', '.', $content);
$content = str_ireplace(':.', '.', $content);
$content = preg_replace('#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS', '', $content);
$content = preg_replace('(\d{1,2}\/\d{1,2}\/\d{4})', '', $content);
$content = preg_replace('/(http:\/\/)(\S+)/i', '', $content);
$content = preg_replace('/(https:\/\/)(\S+)/i', '', $content);
} else {
preg_match_all('!\<link\>(.*?)\</link\>!siu', $outch, $lines);
unset($lines[1][0]);
shuffle($lines[1]);
$lines[1] = array_slice($lines[1], 0, 10);
foreach ($lines[1] as $line) 
{
$line = trim($line);
$badchar = array ("\n","\r","\t",'&nbsp;','&laquo;','&raquo;','&quot;','&#8592;','&#8594;','&#39;','&#8211;','&#32;','&#160;','&#8212;','&#8230;','&#039;','&rarr;','&mdash;','&gt;','&lt;','{','}','#','"','…');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://rca.yandex.com/?key='.$rcakey.'&url='.urlencode($line).'&img=best&content=full');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 9);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
$rca = @(array)json_decode(curl_exec($ch));
curl_close($ch);
$rca_content = @strip_tags($rca['content']);
$rca_content = str_replace('\n', ' ', $rca_content);
$rca_content = str_replace('...', '.', $rca_content);
$rca_content = str_ireplace($badchar, ' ', $rca_content);
$rca_content = preg_replace('! {2,}!u', ' ', $rca_content);
$rca_content = preg_replace('!^(.{0,'.$maxtext.'})\s.*!su', '$1', $rca_content);
$rca_content = preg_replace('/(http:\/\/)(\S+)/i', '', $rca_content);
$rca_content = preg_replace('/(https:\/\/)(\S+)/i', '', $rca_content);
$rca_content = trim($rca_content);
if ($rca_content != '') {
$content.= '<p>'.$rca_content.'.</p>
'; } else {$content.= '';}
}
$badchar = array ("\n","\r","\t",'&nbsp;','&laquo;','&raquo;','&quot;','&#8592;','&#8594;','&#39;','&#8211;','&#32;','&#160;','&#8212;','&#8230;','&#039;','&rarr;','&mdash;','&gt;','&lt;','{','}','#','"');
$content = str_ireplace($badchar, ' ', $content);
$content = str_ireplace('...', '.', $content);
$content = str_ireplace(' .', '.', $content);
$content = str_ireplace('..', '.', $content);
$content = str_ireplace(',.', '.', $content);
$content = str_ireplace(':.', '.', $content);
$content = preg_replace('#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS', '', $content);
$content = preg_replace('(\d{1,2}\/\d{1,2}\/\d{4})', '', $content);
$content = preg_replace('/(http:\/\/)(\S+)/i', '', $content);
$content = preg_replace('/(https:\/\/)(\S+)/i', '', $content);
}
if ($maxfoto == '0') {
$fotos = '';
} else {
if (mb_strlen($key, 'utf-8') > 30) {$keyimg = preg_replace('!^(.{0,30})\s.*!su', '$1', $key);} else {$keyimg = $key;}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://twitter.com/search?q='.urlencode($keyimg).'&src=typd&mode=photos');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$outch = curl_exec($ch);
curl_close($ch);
preg_match_all('!data-resolved-url-small="(.*?)"!siu', $outch, $lines1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.bing.com/images/search?q='.urlencode($keyimg.' site:vk.com'));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
preg_match_all('!imgurl:&quot;(.*?)&quot;,ow:&quot;!siu', $outch, $lines2);
$foto = array_merge($lines1[1], $lines2[1]);
$fotos = implode('|f|', $foto);
}
$put = '<xml>
<key><![CDATA['.$key.']]></key>
<content><![CDATA['.$content.']]></content>
<link><![CDATA['.$link.']]></link>
<foto><![CDATA['.$fotos.']]></foto>
</xml>';
if (!is_dir('page/'.mb_substr(md5($key), 1, 4, 'utf-8')))  mkdir('page/'.mb_substr(md5($key), 1, 4, 'utf-8'));
file_put_contents('page/'.mb_substr(md5($key), 1, 4, 'utf-8').'/'.md5($key).'.txt', $put);
file_put_contents('sitemap.txt', $key."\n", FILE_APPEND | LOCK_EX);
}
}
$fotos = explode('|f|', $fotos);
shuffle($fotos);
$fotos = array_slice($fotos, 0, $maxfoto);
$foto = '';
foreach ($fotos as $line) 
{
$line = trim($line);
$foto.= '<img src="'.$line.'" style="float:left; margin:5px; vertical-align:top; width:'.$widthfoto.'; height:'.$heightfoto.';" title="'.$key.'" alt="'.$key.'"  class="img-responsive" />';
}
$description = trim(strip_tags(str_ireplace(' .', '.', $content)));
$description = preg_replace('!^(.{0,150})\s.*!su', '$1', $description);
$title_1 = trim(mb_strtoupper(mb_substr($key, 0, 1, 'utf-8'), 'utf-8'));
$title_2 = trim(mb_strtolower(mb_substr($key, 1, 100, 'utf-8'), 'utf-8'));
$key = $title_1.$title_2;
$content = $indexkeys.$content;
$breadcrumbs = '';
$keyarr = explode(' ', $key);
$keycount = count($keyarr);
if ($keycount == 2) {$breadcrumbs = '<div class="breadcrumb">
  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.$dir.'" itemprop="url"><span itemprop="title">'.$host.'</span></a></span> » 
  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.$key.'</span></span>
</div>';} elseif ($keycount == 1) {$breadcrumbs = '';} else {
$breadcrumbskey = $keyarr[0].' '.$keyarr[1];
$breadcrumbskey2 = str_ireplace(' ', '-', $breadcrumbskey);
$breadcrumbs = '<div class="breadcrumb">
  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.$dir.'" itemprop="url"><span itemprop="title">'.$host.'</span></a></span> » 
  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.$dir.urlencode(mb_strtolower($breadcrumbskey2, 'utf-8')).'/" itemprop="url"><span itemprop="title">'.$breadcrumbskey.'</span></a></span> » 
  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.$key.'</span></span>
</div>';
}
preg_match_all('!\<p\>(.*?)\</p\>!siu', $content, $cnt1);
$cnt = $cnt1[1];
require_once 'templates.txt';
