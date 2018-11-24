<?php

class Controller_Media extends Controller {

	public function __construct() {
		$this->model = new Model_Media();
		$this->view = new View();
	}

	public function action_index() {
    $data = $this->model->get_default_data();
		$this->view->generate('view_media.php', 'view_template.php',	$data);
	}
}
?>
