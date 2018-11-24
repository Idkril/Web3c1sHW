<?php

class Controller_Canvas extends Controller {

	public function __construct() {
		$this->model = new Model_Canvas();
		$this->view = new View();
	}

	public function action_index() {
		$this->view->generate('view_canvas.php', 'view_template.php');
	}
}
?>
