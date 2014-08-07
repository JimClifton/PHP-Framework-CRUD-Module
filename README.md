This framework currently supports: 
- Select queries for joins, where, orderby and limit.
- Delete
- Update
- Insert

- Authentication module is in progress

How to use this CRUD framework.

Example of a select query:

<?php
include('/classes/database.php');
$db = new Database();
$db->connect();
$db->select('players','*', null, null, null, null); // Table, Columns, Join, Where, Order by, Limit
$res = $db->getResult();
print_r($res);