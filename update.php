<?php
include('classes/database.php');
$db = new Database();
$db->connect();
$db->update('players', array('name'=>"Jay", 'points'=>"4500"), 'player_id="1"');
$res = $db->getResult();
print_r($res);