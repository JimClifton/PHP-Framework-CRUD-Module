<?php

class Database 
{
	// Database config
	private $db_host = 'localhost';
	private $db_user = 'root';
	private $db_pass = '';
	private $db_name = 'db1';

	// Instantiate arrays
	private $result = array();

	// Database connection
	public function connect () {
		$connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass) or die(mysql_error());
		$database = mysql_select_db($this->db_name) or die(mysql_error());
	}

	// Database disconnect
	public function disconnect () {
		mysql_close($connection);
	}

	// Database SELECT Query
	public function select ($table, $rows, $join, $where, $order, $limit) {
		$q = 'SELECT ' . $rows . ' FROM ' . $table;
		if ($join != NULL) {
			$q .= ' JOIN ' . $join;
		}
		if ($where != NULL) {
			$q .= ' WHERE ' . $where;
		}
		if ($order != NULL) {
			$q .= ' ORDER BY ' . $order;
		}
		if ($limit != NULL) {
			$q .= ' LIMIT ' . $limit;
		}

		$query = mysql_query($q);
		if ($query) {
			$this->numResults = mysql_num_rows($query);
			for ($i = 0; $i < $this->numResults; $i++) {
				$r = mysql_fetch_array($query);
				$key = array_keys($r);
				for ($x = 0; $x < count($key); $x++) {
					if (!is_int($key[$x])) {
						if (mysql_num_rows($query) >= 1) {
							$this->result[$i][$key[$x]] = $r[$key[$x]];
						} else {
							$this->result = null;
						}
					}
				}
			}
			return true;
		} else {
			array_push($this->result,mysql_error());
			return false;
		}
	}

	// Database INSERT Query
	public function insert ($table, $params = array()) {
		$q = 'INSERT INTO '. $table . ' (' . implode(', ', array_keys($params)) . ') VALUES ("' . implode('", "', $params) . '")';
		if ($ins = mysql_query($q)) {
			array_push($this->result, mysql_insert_id());
			return true;
		} else {
			array_push($this->result, mysql_error());
			return false;
		}
    }

    // Database UPDATE Query
	public function update ($table, $params=array(), $where) {
		$args = array();
		foreach ($params as $field=>$value) {
			$args[] = $field . '="' . $value . '"';
		}
		$q = 'UPDATE ' . $table . ' SET ' . implode(',', $args) . ' WHERE ' . $where;
		if ($query = mysql_query($q)) {
			array_push($this->result, mysql_affected_rows());
			return true;
		} else {
			array_push($this->result,mysql_error());
			return false;
		}
	}

	// Database DELETE Query
	public function delete ($table, $where) {
		$delete = 'DELETE FROM ' . $table . ' WHERE ' . $where;
		if ($del = @mysql_query($delete)) {
			array_push($this->result,mysql_affected_rows());
			$this->myQuery = $delete;
			return true;
		} else {
			array_push($this->result,mysql_error());
			return false;
		}
	}

	// Database build result array
	public function getResult () {
		$val = $this->result;
		$this->result = array();
		return $val;
	}

	// Database clean input for SQL
	public function escapeString ($data) {
        return mysql_real_escape_string($data);
    }
}