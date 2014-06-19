<?php
include('/classes/database.php');
$db = new Database();
$db->connect();
$db->delete('players', 'player_id = 7');
$res = $db->getResult();
print_r($res);