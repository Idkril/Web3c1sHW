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
     echo $_POST['login'];
   }
   else {
     echo mysqli_error($conn);
     echo 1;
   }
 }
?>
