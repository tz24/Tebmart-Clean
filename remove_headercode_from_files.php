<?php

// Search ? ><?php in the list of files
// run file
// Usage 1: http://restorefacebodysoul.com.au/remove_headercode_from_files.php			- to analyze
// Usage 2: http://restorefacebodysoul.com.au/remove_headercode_from_files.php?rewrite=1	- to analyze and clean

$filelist = '//wp-content/themes/kinex/woocommerce/emails/email-order-items.php
//wp-content/themes/twentyfourteen/single.php
//wp-content/themes/twentyfourteen/inc/back-compat.php
//wp-content/plugins/jetpack/modules/holiday-snow.php
//wp-content/plugins/jetpack/modules/shortcodes/flickr.php
//wp-content/plugins/visual-form-builder/includes/class-widget.php
//wp-content/plugins/woocommerce/classes/emails/class-wc-email-customer-new-account.php
//wp-content/plugins/woocommerce/templates/loop-shop.php
//wp-content/plugins/woocommerce/templates/emails/admin-new-order.php
//wp-content/plugins/woocommerce/templates/loop/add-to-cart.php
//wp-content/plugins/woocommerce/templates/myaccount/form-login_bkp.php
//wp-content/plugins/revslider/inc_php/elements_base.class.php
//wp-content/plugins/revslider/inc_php/settings_output.class.php
//wp-content/plugins/revslider/inc_php/revslider_globals.class.php
//wp-content/plugins/woocommerce-checkout-manager/woocommerce-checkout-manager.php
//wp-includes/registration-functions.php
//wp-includes/feed-rss2-comments.php
//wp-includes/ID3/module.audio.ac3.php
//wp-includes/js/tinymce/langs/wp-langs.php';


if (count($argv) > 1)
{
	if ($argv[1] == 'clean' && $flag_rewrite == 0) $flag_rewrite = 1;
	else $flag_rewrite = 0;
}
else $flag_rewrite = intval($_GET['clean']);

if ($flag_rewrite == 0)
{
	echo '<p style="color:red">!!!!! Only analyze and find. Nothing cleaned. Add ?clean=1 to clean  !!!</p>';
}

$link_clean = 'http://'.$_SERVER['HTTP_HOST'].'/remove_headercode_from_files.php?clean=1';
$link_start = 'http://'.$_SERVER['HTTP_HOST'].'/remove_headercode_from_files.php';

echo '<p>Commands: <br><br>
Cleaning: <a href="'.$link_clean.'">'.$link_clean.'</a> <br><br>
Start: <a href="'.$link_start.'">'.$link_start.'</a> <br><br>
</p>';

$flag_full_path = false;

$i_counter = 0;


$a = explode("\n", $filelist);
if (count($a) == 0)
{
	echo 'Empty list';
	exit;
}
/*
$filelist = array();
$flag_full_path = true;

		$path[] = dirname(__FILE__)."/*";
		//$path[] = "/var/www/gcn2/*";
		//$path[] = "/var/www/gcnsystem/public_html/*";
		//$path[] = "/var/www/ogn_releases/*";

		//$path[] = "/var/www/golfopenevents.co.uk/*";
		//$path[] = "/var/www/golfregistrationwales.co.uk/guw_releases/GUW_5/*";

		 while(count($path) != 0)
		 {
		     $v = array_shift($path);


		     foreach(glob($v) as $item)
             {
		         if (is_dir($item))
                 {
		             $path[] = $item . '/*';
                 }
		         elseif (is_file($item))
		         {
		              //do analyze
		              //echo $item."<br>";

					$filename = $item;

					$file_ext = strtolower( substr( $filename, strrpos($filename, ".") ) );

					if ($file_ext == '.php')
					{
						$filelist[] = $item;
					}

		     	  }
             }
		 }


$a = $filelist;

echo "Total PHP ".count($filelist)."<br><br>";
*/
$pos_a = array();
$found_files = array();
$output = array();

foreach ($a as $filename)
{
	$filename = trim($filename);
	if (!$flag_full_path) $filename = dirname(__FILE__).$filename;

	echo 'File: '.$filename.' ['.date("Y-m-d H:i",filemtime($filename)).']';
	$output[] = 'File: '.$filename;
	if (file_exists($filename) === false)
	{
		echo ' - <font color="red">file is not exist</font>'."<br	>";
		$output[] = '*** file is not exist ***';
		continue;
	}

	$handle = fopen($filename, "rb");
	$contents = fread($handle, filesize($filename));
	fclose($handle);


	$pos = strpos($contents, "?><?php");
	/*$pos = strpos($contents, "cvtqo-1; ?>");*/

	if ( $pos !== false)
	{
		$pos_a[$pos] += 1;

		$found_files[] = $filename;

		$new_content = substr($contents, $pos+2);
		//$new_content = substr($contents, $pos+11);
		//echo $new_content; exit;

		if ($flag_rewrite == 1 )
		{
			$fp = fopen($filename, 'w');
			fwrite($fp, $new_content);
			fclose($fp);

			echo ' - <font color="green">cleaned</font>'."<br>";
			$output[] = 'cleaned';
		}
		else {
			echo ' - pos: '.$pos."<br>";
			$output[] = 'pos '.$pos;
		}

		$i_counter++;
	}
	else {
		echo ' - <font color="red">pos not found</font>'."<br>";
		$output[] = '*** pos not found ***';
	}


}


echo "<br><br><br><br>Counter: ".$i_counter."<br><br>";

echo print_r($pos_a, true);

echo "<br><br>";

foreach ($found_files as $filename)
{
	echo str_replace(dirname(__FILE__), "", $filename)."<br>";
}

print_r($output);


?>