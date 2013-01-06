<?php

$auth_result = null;
$token = null;
$xid = null;

function getRequestData($url, $data) {

	$options = array(
		'http' => array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	$result = json_decode($result, true);

	return $result;
}

$url = 'https://jawbone.com/user/signin/login';
$data = array(
	"email" => strtolower($_POST['email']),
	"pwd" => $_POST['pwd'],
	"service" => "nudge"
);

$auth_result = getRequestData($url, $data);

if(isset($auth_result['token'])) {

	$token = $auth_result['token'];
	$xid = $auth_result['user']['xid'];
}


$data = array(
	"date" => date("Y-n-j"),
	"timezone" => -28800,
	"move_goal" => 0,
	"sleep_goal" => 0,
	"eat_goal" => 0,
	"check_levels" => 1,
	"_token" => $token
);
$daily_summary = getRequestData("https://jawbone.com/nudge/api/users/$xid/healthCredits", $data);

echo "<pre>"; print_r($daily_summary); echo "</pre>";




