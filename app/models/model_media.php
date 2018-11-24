<?php
class Model_Media extends Model {

  private $db;

  public function __construct() {
		$this->db = new DB_handler();
		$connect = $this->db->connect();
	}

  public function get_default_data() {
    return $this->db->make_request('SELECT id,AVName,Type,FilePath FROM audiovideo');
  }
}
?>
