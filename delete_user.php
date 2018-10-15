<html>
<?php
 include('DB_conn.php');
 $res=mysqli_query($conn,sprintf('DELETE FROM users WHERE id="'.$_POST['someid'].'" '));
if ($res) {
  echo 'User with id = '.$_POST['someid'].' has been deleted';
} else {
  echo 'ERROR '.$res;
}
?>
</html>
