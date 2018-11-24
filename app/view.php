<?php
class View
{
	function generate($content_view, $template_view, $data = null) {
		include_once 'app/views/'.$template_view;
	}
}
?>
