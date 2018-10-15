<html>
<?php
session_start();
$_SESSION['login']=$_POST['login'];
$_SESSION['role']=1;
include('DB_conn.php');
$hpass=md5($_POST['password']);
//$res=mysqli_query($conn,"INSERT INTO users (login,password,FirstName,LastName) VALUES (".$_POST['login'].",".$hpass.",".$_POST['FirstName'].",".$_POST['LastName'].")");
$res=mysqli_query($conn,sprintf('INSERT INTO users (`login`,`password`,`FirstName`,`LastName`) VALUES ("%s","%s","%s","%s")',$_POST['login'],$hpass,$_POST['FirstName'],$_POST['LastName']));
//$result = mysql_query(sprintf('INSERT INTO `%s` (`id`, `type`) VALUES ("%s", "%s")',$id_ales,$id_chold,$type));
if ($res)
{
  echo 'Regisatration successfull. Redirecting...';
  echo '<meta http-equiv="refresh" content="2;url=index.php">';
}
else {
  echo 'ERROR';
  echo mysqli_error($conn);
}
?>
</html>
