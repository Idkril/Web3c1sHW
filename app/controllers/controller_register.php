<?php

class Controller_Register extends Controller {

	public function __construct() {
		$this->model = new Model_Register();
		$this->view = new View();
	}

	public function action_index() {
		$this->view->generate('view_register.php', 'view_template.php');
	}

	public function action_registration() {
		$this->model->registration($_POST['login'],$_POST['password'],$_POST['FirstName'],$_POST['LastName']);
		header('Location: http://localhost');
	}

}
?>
