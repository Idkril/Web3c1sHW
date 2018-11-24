<?php

class Model_Profile extends Model {

	private $db;

	public function __construct() {
		$this->db = new DB_handler();
		$connect = $this->db->connect();
	}

	public function get_default_data($id) {
		return $this->db->make_request('SELECT * FROM users WHERE id='.$id);
	}

	public function update_profile_as_admin($login,$fname,$lname, $pass, $role, $id) {
		if ($pass>0) {
		 $this->db->make_request('UPDATE users SET login="'.$login.'",FirstName="'.$fname.'",LastName="'.$lname.'",password="'.$pass.'",Role="'.$role.'" WHERE id='.$id);
		}
		else {
		 $this->db->make_request('UPDATE users SET login="'.$login.'",FirstName="'.$fname.'",LastName="'.$lname.'",Role="'.$role.'" WHERE id='.$id);
		}
	}

	public function update_profile_as_user($fname,$lname, $pass, $id) {
		if ($pass>0) {
		 $this->db->make_request('UPDATE users SET FirstName="'.$fname.'",LastName="'.$lname.'",password="'.$pass.'" WHERE id='.$id);
		}
		else {
		 $this->db->make_request('UPDATE users SET FirstName="'.$fname.'",LastName="'.$lname.'" WHERE id='.$id);
		}
	}

	public function file_handle($filePath,$errorCode,$user_upd_id) {
		if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
	    $errorMessages = [
	        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
	        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
	        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
	        UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
	        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
	        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
	        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
	    ];

	    $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

	    $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

	    //die($outputMessage);
		}

		$fi = finfo_open(FILEINFO_MIME_TYPE);

		$mime = (string) finfo_file($fi, $filePath);

		if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

		$image = getimagesize($filePath);

		$extension = image_type_to_extension($image[2]);

		$format = str_replace('jpeg', 'jpg', $extension);

		if (!move_uploaded_file($filePath,  __DIR__ .'/../../assets/img_userphoto/' . $user_upd_id . $format)) {
		    die('При записи изображения на диск произошла ошибка.');
		}
		$resultt=$this->db->make_request('UPDATE users SET Photo="'.$format.'" WHERE id='.$user_upd_id);
		return $format;
	}

}
?>
