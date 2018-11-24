<?php

class Model_main extends Model {
	private $db;

	public function __construct() {
		$this->db = new DB_handler();
		$connect = $this->db->connect();
	}

	public function get_default_data() {
		$result = $this->db->make_request('SELECT id,FirstName,LastName,Role,Photo FROM users');
		return $result;
	}

	public function delete_user($id) {
		$this->db->make_request(sprintf('DELETE FROM users WHERE id="'.$_POST['someid'].'" '));
		return 1;
	}

	public function log_in($login, $pass) {
		$hpass=md5($pass);
		$res = $this->db->make_request(sprintf('SELECT Role FROM users WHERE login="%s" AND password="%s"',$login,$hpass));
		if ( mysqli_num_rows($res) > 0) {
     $_SESSION['login']=$login;
     $row=mysqli_fetch_array($res);
     $_SESSION['role']=$row['Role'];
     return $login;
   }
   else {
     return 1;
   }
	}

	public function getuserstable($orderw) {
		$reshtml=' ';
		$res;
		switch ($orderw) {
		  case 0:
		    //$res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY id DESC');
				$res=$this->db->make_request('SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY id DESC');
		    break;
		  case 1:
		    //$res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users');
				$res=$this->db->make_request('SELECT id,FirstName,LastName,Role,Photo FROM users');
		    break;
		  case 2:
		    //$res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY FirstName');
				$res=$this->db->make_request('SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY FirstName');
		    break;
		  case 3:
		    //$res=mysqli_query($conn,'SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY FirstName DESC');
				$res=$this->db->make_request('SELECT id,FirstName,LastName,Role,Photo FROM users ORDER BY FirstName DESC');
		    break;
		}

		switch ($_SESSION['role']) {
		  case 0: //guest
		    while ($row = mysqli_fetch_array($res))
		    {
			    $reshtml=$reshtml. '<tr>';

			    $reshtml=$reshtml. '<td>';
			    $reshtml=$reshtml. $row['id'];
			    $reshtml=$reshtml. '</td>';

			    $reshtml=$reshtml. '<td>';
			    $reshtml=$reshtml. $row['FirstName'];
			    $reshtml=$reshtml. '</td>';

			   $reshtml=$reshtml. '<td>';
			   $reshtml=$reshtml. $row['LastName'];
			    $reshtml=$reshtml. '</td>';

			   $reshtml=$reshtml. '<td>';
			    switch($row['Role'])
			    {
			      case 1:
			        $reshtml=$reshtml. 'User';
			        break;
			      case 2:
			        $reshtml=$reshtml. 'Admin';
			        break;
			    }
			    $reshtml=$reshtml. '</td>';

			    $reshtml=$reshtml. '<td>';
			    if ($row['Photo']=="0") {
			      $reshtml=$reshtml. '<img class="img_userphoto_intable" src="assets/img_userphoto/0.png" alt="Photo">';
			    } else {
			        $reshtml=$reshtml. '<img class="img_userphoto_intable" src="assets/img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
			    }
			    $reshtml=$reshtml. '</td>';

			    $reshtml=$reshtml. '</tr>';
		    }
		    break;

		  case 1: //default user
		    while ($row = mysqli_fetch_array($res))
		    {
		    $reshtml=$reshtml. '<tr>';

		    $reshtml=$reshtml. '<td>';
		    //$reshtml=$reshtml. $row['id'];
		    $reshtml=$reshtml. '<form name="toprofile" method="post" action="/profile"><input type="hidden" name="someid" value="'.$row['id'].'"><button class="button_bluetext">'.$row['id'].'</button></form>';
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    $reshtml=$reshtml. $row['FirstName'];
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    $reshtml=$reshtml. $row['LastName'];
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    switch($row['Role'])
		    {
		      case 1:
		        $reshtml=$reshtml. 'User';
		        break;
		      case 2:
		        $reshtml=$reshtml. 'Admin';
		        break;
		    }
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    if ($row['Photo']=="0") {
		      $reshtml=$reshtml. '<img class="img_userphoto_intable" src="assets/img_userphoto/0.png" alt="Photo">';
		    } else {
		        $reshtml=$reshtml. '<img class="img_userphoto_intable" src="assets/img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
		    }
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '</tr>';
		    }
		    break;

		  case 2: //ADMIN

		    while ($row = mysqli_fetch_array($res))
		    {
		    $reshtml=$reshtml. '<tr id="ti'.$row['id'].'">';

		    $reshtml=$reshtml. '<td>';
		    $reshtml=$reshtml. '<form name="toprofile" method="post" action="/profile"> <input type="hidden" name="someid" value="'.$row['id'].'"> <button class="button_bluetext">'.$row['id'].'</button></form>';
		    $reshtml=$reshtml. '</td>';
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    $reshtml=$reshtml. $row['FirstName'];
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    $reshtml=$reshtml. $row['LastName'];
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    switch($row['Role'])
		    {
		      case 1:
		        $reshtml=$reshtml. 'User';
		        break;
		      case 2:
		        $reshtml=$reshtml. 'Admin';
		        break;
		    }
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    if ($row['Photo']=="0") {
		      $reshtml=$reshtml. '<img class="img_userphoto_intable" src="assets/img_userphoto/0.png" alt="Photo">';
		    } else {
		        $reshtml=$reshtml. '<img class="img_userphoto_intable" src="assets/img_userphoto/'.$row['id'].$row['Photo'].'?'.time().'">';
		    }
		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '<td>';
		    $reshtml=$reshtml. '<button class="button_bluetext" onclick="deluser('.$row['id'].')">X</button>';

		    $reshtml=$reshtml. '</td>';

		    $reshtml=$reshtml. '</tr>';
		    }
		    break;
			}

			return $reshtml;
		}
}
?>
