<?php

class DB_handler {

  private $dbhost='localhost:3306';
  private $dbuser='WebDes';
  private $dbpass='1111';
  private $dbname='web';
  private $connect;

  function __construct() {
	}
/*
	function __construct($host, $user, $password) {
	   $this->dbhost = $host;
		 $this->dbuser = $user;
		 $this->dbpass = $password;
	}
*/

  public function connect() {
	   $this->connect = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
	}

	public function set_dbname($db_name) {
	   $this->dbname=$db_name;
	}

	public function make_request($request) {
	   return mysqli_query($this->connect, $request);
	}
}
?>
