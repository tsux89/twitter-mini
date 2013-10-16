<?php

require_once('UltimateOAuth.php');
ini_set('display_errors', '1');
error_reporting(E_ALL);

$un = '';
$pw = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $un = htmlspecialchars($_POST["un"], ENT_QUOTES);
    $pw = htmlspecialchars($_POST["pw"], ENT_QUOTES);
} else {
    echo "PLEASE ACCESS FROM THE FORM PAGE.";
    exit(1);
}



$uo = new UltimateOAuth('RwYLhxGZpMqsWZENFVw', 'Jk80YVGqc7Iz1IDEjCI6x3ExMSBnGjzBAH6qHcWJlo');

$res = $uo->directGetToken($un, $pw);
if (isset($res->errors)) {
	die($res->errors[0]->message);
}

echo '<b>What\'s are you doing now?</b><form action="tweet.php" method="post"><textarea name="text" cols="50" rows="10"></textarea><br><input type="submit" value="Tweet"><br><br><hr></form>';

$res = $uo->get('statuses/home_timeline', array('count' => '20'));

foreach ( $res as $status ){
	$status_id = $status->id_str;
    $text = $status->text;
    $user_id = $status->user->id_str;
    $screen_name = $status->user->screen_name;
    $name = $status->user->name;
    echo '<b>'.$screen_name.'/'.$name.'</b><br>'.$text.'<br><hr>';
}

?>
