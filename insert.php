<?php
include('classes/database.php');
$db = new Database();
$db->connect();
$name = $db->escapeString("Jimmy");
$points = $db->escapeString("346");
$db->insert('players', array('name' => $name, 'points' => $points));
$res = $db->getResult();
print_r($res);