<?php
/* Start WordPress */
if( function_exists('explode') ){
    $parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
    $wp_load = $parse_uri[0].'wp-load.php';
    require_once($wp_load);
}else{
    echo '<p>Do not working "<strong>explode()</strong>" function on your server. Please talk hosting provider.</p>';
    die(1);
}

add_filter( 'theme_mail_spam', 'theme_mail_check_spam', 10, 5);
add_filter( 'theme_mail_spam', 'theme_mail_akismet', 10, 5);

$sitename 	= get_bloginfo('name');
$to 		 	= isset($_POST['to'])?trim(base64_decode($_POST['to'])):'';
$name 	 	= isset($_POST['name'])?trim($_POST['name']):'';
$email 	 	= isset($_POST['email'])?trim($_POST['email']):'';
$content  	= isset($_POST['message'])?trim($_POST['message']):'';
$recaptcha	= isset($_POST['recaptcha_challenge_field'])?trim($_POST['recaptcha_challenge_field']):'';

/* if has recaptcha */
if( $recaptcha ){
	
	if( !function_exists ('_recaptcha_qsencode') ) {
		require_once ( T_PATH .'/'. F_REQ . "/plugins/recaptcha/recaptchalib.php" );
	}
	$publickey 		= get_theme_option('advanced', 'recaptcha_public_key');
	$privatekey		= get_theme_option('advanced', 'recaptcha_private_key');
	$resp 			= recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
	$response		= $resp->is_valid;
}

$error = false;
if($to === '' || $name === '' || $email === '' || $message === ''){
	$error = true;
}
if(!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)){
	$error = true;
}
if(!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $to)){
	$error = true;
}

$error = apply_filters('theme_mail_spam', $error, $name, $email, $content, $to);

if($error == false){
	$subject = sprintf(__('%1$s\'s message from %2$s', T_NAME), $sitename, $name);
	$body = __('Site: ', T_NAME).$sitename."\n\n";
	$body .= __('Name: ', T_NAME).$name."\n\n";
	$body .= __('Email: ',T_NAME).$email."\n\n";
	$body .= __('Messages: ',T_NAME). stripslashes($content);
	$headers = "From: $name <$email>\r\n";
	$headers .= "Reply-To: $email\r\n";
	
	if( $recaptcha && !$response ){
		echo 'error-recaptcha';
	}else if( !wp_mail($to, $subject, $body, $headers) ){
		echo 'fail';
	}
	
}else{
	echo 'fail';
}

function theme_mail_akismet( $error, $author, $author_email, $content, $send_to ) {
	if($error == true){
		return true;
	}
	if ( ! function_exists( 'akismet_get_key' ) || ! akismet_get_key() )
		return false;

	global $akismet_api_host, $akismet_api_port;
	
	$c = array();
	$c['blog'] = home_url();
	$c['blog_lang'] = get_locale();
	$c['blog_charset'] = get_option( 'blog_charset' );
	$c['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
	$c['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$c['referrer'] = $_SERVER['HTTP_REFERER'];
	$c['permalink'] = get_site_url();
	$c['comment_type'] = 'contactform';

	if ( '' != $author )
		$c['comment_author'] = $author;

	if ( '' != $author_email )
		$c['comment_author_email'] = $author_email;
	
	if ( '' != $content )
		$c['comment_content'] = $content;

	$ignore = array( 'HTTP_COOKIE', 'HTTP_COOKIE2', 'PHP_AUTH_PW' );

	foreach ( $_SERVER as $key => $value ) {
		if ( ! in_array( $key, (array) $ignore ) )
			$c["$key"] = $value;
	}
	
	$query_string = '';

	foreach ( $c as $key => $data )
		$query_string .= $key . '=' . urlencode( stripslashes( (string) $data ) ) . '&';

	$response = akismet_http_post( $query_string,
		$akismet_api_host, '/1.1/comment-check', $akismet_api_port );
	
	if ( 'true' == $response[1] ){
		return true;
	}else{
		return false;
	}
}

function theme_mail_check_spam( $error, $author, $author_email, $content, $send_to ) {
	if($error == true){
		return true;
	}
	if(!isset($_SERVER['HTTP_USER_AGENT'])){
		return true;
	}

	/*  Make sure the form was POST'ed: */
	if(!$_SERVER['REQUEST_METHOD'] == "POST"){
		return true;
	}

	/*  Must sure it's referer to your wordpress site */
	if( !isset($_SERVER['HTTP_REFERER']) || trim($_SERVER['HTTP_REFERER']) == '' ){
		return true;
	} else {
		$fromArray = parse_url(strtolower($_SERVER['HTTP_REFERER']));
		$siteArray = parse_url(strtolower(get_site_url()));

		if(preg_replace("/^www\./i",'',$fromArray['host']) != preg_replace("/^www\./i",'',$siteArray['host'])){
			return true;
		}
	}
	
	/* 
		Check posted input for email injection attempts
		Check for these common exploits
		if you edit any of these do not break the syntax of the regex 
	*/
	$input_expl = "/(content-type|mime-version|content-transfer-encoding|to:|bcc:|cc:|document.cookie|document.write|onmouse|onkey|onclick|onload)/i";
	/*  Loop through each POST'ed value and test if it contains one of the exploits fromn $input_expl: */
	foreach($_POST as $k => $v){
		if (is_string($v)){
			$v = strtolower($v);
			if( preg_match($input_expl, $v) ){
				return true;
			}
		}
	}
	return false;
}
?>