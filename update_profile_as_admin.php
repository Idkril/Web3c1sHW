<html>
<?php
include('DB_conn.php');
if ($_POST['pwd']>0) {
  $res=mysqli_query($conn,'UPDATE users SET login="'.$_POST['login'].'",FirstName="'.$_POST['FirstName'].'",LastName="'.$_POST['LastName'].'",password="'.md5($_POST['pwd']).'",Role="'.$_POST['role'].'" WHERE id='.$_POST['someid']);
}
else {
  $res=mysqli_query($conn,'UPDATE users SET login="'.$_POST['login'].'",FirstName="'.$_POST['FirstName'].'",LastName="'.$_POST['LastName'].'",Role="'.$_POST['role'].'" WHERE id='.$_POST['someid']);
  //echo "wooo";
}
header('Location: index.php');
 //include('DB_conn.php');
 //$res=mysqli_query($conn,'UPDATE users SET users WHERE id='.$_POST['someid']);
?>
