<?php

$data = array("email" => strtolower($_POST['email']), "pwd" => $_POST['pwd'], "service" => "nudge");
$data_string = json_encode($data);

$ch = curl_init('https://jawbone.com/user/signin/login');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);



$info = curl_getinfo($ch);
curl_close($ch);

echo "<pre>"; print_r($result); echo "</pre>";
echo "<pre>"; print_r($info); echo "</pre>";




