<html>
<?php
 session_start();
 if (count($_POST)>0)
 {
   $hpass=md5($_POST['password']);

   include('DB_conn.php');
  $res=mysqli_query($conn,sprintf('SELECT Role FROM users WHERE login="%s" AND password="%s"',$_POST['login'],$hpass));
   if ( mysqli_num_rows($res) > 0)
   {
     $_SESSION['login']=$_POST['login'];
     $row=mysqli_fetch_array($res);
     $_SESSION['role']=$row['Role'];
     header('Location: index.php');
   }
   else {
     echo mysqli_error($conn);
     echo 'Wrong login/password. Redirecting...';
     echo '<meta http-equiv="refresh" content="2;url=index.php">';
     //header('Location: index.php',true,303);
   }
 }
?>
</html>
