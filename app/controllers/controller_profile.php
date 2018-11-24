<?php

class Controller_Profile extends Controller {

	public function __construct() {
		$this->model = new Model_Profile();
		$this->view = new View();
	}

	public function action_index() {
		if (!$_POST['someid']) {
   		header('Location: /main');
 		}
		$data= $this->model->get_default_data($_POST['someid']);
		$this->view->generate('view_profile.php', 'view_template.php',	$data);
	}

	public function action_update_profile_as_admin() {
		$this->model->update_profile_as_admin($_POST['login'],$_POST['FirstName'],$_POST['LastName'], md5($_POST['pwd']), $_POST['role'], $_POST['someid']);
	}

	public function action_update_profile_as_user() {
		$this->model->update_profile_as_user($_POST['FirstName'],$_POST['LastName'], md5($_POST['pwd']), $_POST['someid']);
	}

	public function action_file_handle() {
		$filePath  = $_FILES['file']['tmp_name'];
		$errorCode = $_FILES['file']['error'];
		$user_upd_id=$_POST['user_upd_id'];
		echo $this->model->file_handle($filePath, $errorCode, $user_upd_id);
	}
}
?>
