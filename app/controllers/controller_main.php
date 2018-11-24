<?php

class Controller_Main extends Controller {

	public function __construct() {
		$this->model = new Model_main();
		$this->view = new View();
	}

	public function action_index() {
		$data = $this->model->get_default_data();
		$this->view->generate('view_main.php', 'view_template.php', $data);
	}

	public function action_auth() {
		$data = $this->model->log_in($_POST['login'], $_POST['password']);
		echo $data;
	}

	public function action_getuserstable() {
		$data=$this->model->getuserstable($_POST['orderw']);
		echo $data;
	}

	public function action_delete_user() {
		$data=$this->model->delete_user($_POST['someid']);
		echo $data;
	}

	public function action_logout() {
		unset($_SESSION['login']);
 		unset($_SESSION['role']);
 		session_destroy();
		echo 1;
	}

}
?>
