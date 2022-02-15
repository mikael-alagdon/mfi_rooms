<?php
	
class Connection {
	private $host = "localhost";
	private $user = "root";
	private $pwd = "";
	private $db = "db_mfirooms";

	protected function connect() {
		// Data Source Name
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
		$pdo = new PDO($dsn, $this->user, $this->pwd);

		// Fetching data. NOTE: this is optional  
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	  return $pdo;
	}

}
