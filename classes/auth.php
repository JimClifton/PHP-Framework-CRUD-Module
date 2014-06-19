<?php

class Auth
{
	public function login($username, $password) {
		$db = new Database();
		$db->connect();
		$db->select('sc_users','*', null, "username='$username' AND password='$password'", null, null); // Table, Columns, Join, Where, Order by, Limit
		$res = $db->getResult();
		return $res;
	}
	
}