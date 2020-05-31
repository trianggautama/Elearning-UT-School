<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');//ganti dengan user anda
define('DB_PASSWORD', 'root'); //ganti dengan password anda
define('DB_DATABASE', 'reporting2'); // ganti dengan database anda



class DB_con {
	public $connection;
	function __construct(){
		$this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
		
		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);
		
	}
	
	function ret_obj(){
		return $this->connection;
	}

}
//luar
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);