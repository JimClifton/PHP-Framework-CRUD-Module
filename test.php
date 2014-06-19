<?php
include('/classes/auth.php');
include('/classes/database.php');

$au = new Auth();
$res = $au->login('james', md5('pw1'));
//print_r($res);

if(count($res) > 0) {
	foreach ($res as $val) {
		echo "Welcome back " . $val["username"];
	}
} else {
	echo "Wrong username or password";
}

