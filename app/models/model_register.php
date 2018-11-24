<?php

class Model_Register extends Model {

	private $db;

	public function __construct() {
		$this->db = new DB_handler();
		$connect = $this->db->connect();
	}

	function action_index() {
		$this->view->generate('view_register.php', 'view_template.php');
	}

	public function registration($login,$pass,$fname,$lname) {
		$_SESSION['login']=$login;
		$_SESSION['role']=1;
		$hpass=md5($pass);
		$res=$this->db->make_request(sprintf('INSERT INTO users (`login`,`password`,`FirstName`,`LastName`) VALUES ("%s","%s","%s","%s")',$login,$hpass,$fname,$lname));
		if ($res) {
			return 0;
		} else {
			return 1;
		}
	}

}
?>
