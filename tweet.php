<?php
	
	require_once('UltimateOAuth.php');
	ini_set('display_errors', '1');
	error_reporting(E_ALL);
	
	$text = '';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$text = htmlspecialchars($_POST["text"], ENT_QUOTES);
	}
	
	$uo = new UltimateOAuth('RwYLhxGZpMqsWZENFVw', 'Jk80YVGqc7Iz1IDEjCI6x3ExMSBnGjzBAH6qHcWJlo'); // Twitter for Android
	
	require('home.php');
	
	$res = $uo->directGetToken($un, $pw);
	if (isset($res->errors)) {
	die($res->errors[0]->message);
	}
	
	$res = $uo->post('statuses/update', 'status='. $text);
	
	echo $text. 'がツイートされました。';


?>
