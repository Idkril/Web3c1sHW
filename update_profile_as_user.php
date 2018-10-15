<html>
<?php
include('DB_conn.php');
if ($_POST['pwd']>0) {
  $res=mysqli_query($conn,'UPDATE users SET FirstName="'.$_POST['FirstName'].'",LastName="'.$_POST['LastName'].'",password="'.md5($_POST['pwd']).'" WHERE id='.$_POST['someid']);
}
else {
  $res=mysqli_query($conn,'UPDATE users SET FirstName="'.$_POST['FirstName'].'",LastName="'.$_POST['LastName'].'" WHERE id='.$_POST['someid']);
}
?>
