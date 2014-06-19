<?php
include('/classes/database.php');
$db = new Database();
$db->connect();
$db->select('players','*', null, null, null, null); // Table, Columns, Join, Where, Order by, Limit
$res = $db->getResult();
print_r($res);