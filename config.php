<?php
// Defining config constants
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');
define('DB_SERVER', 'localhost');
define('DB_DATABASE', 'test');
//Open a connection to the MySQL server we're running on
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); //returns an object which represents the connection

?>