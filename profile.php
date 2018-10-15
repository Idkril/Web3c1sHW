<html>
<link href="css/style.css" rel="stylesheet">
<style>
   .colortext {
    background-color: #ffe; /* Цвет фона */
    color: #930; /* Цвет текста */
   }
</style>
<?php
 session_start();

 include('DB_conn.php');
 if (!$_POST['someid'])
 {
   header('Location: index.php');
 }
 $res=mysqli_query($conn,'SELECT * FROM users WHERE id='.$_POST['someid']);
 if ( mysqli_num_rows($res) > 0)
 {
   //check viewer is the ADMIN and check can/not edit
   echo '<div class="prof_information">';
   $row=mysqli_fetch_array($res);
   if ( $_SESSION['role']==2 ) {
     //all editable by admin
     echo '<form method="POST" action="update_profile_as_admin.php">
     Login: <br>
     <input type="text" name="login" value="'.$row['login'].'" class="colortext"><br>
     New Password: <br>
     <input type="password" name="pwd" class="colortext"><br>
     First Name: <br>
     <input type="text" name="FirstName" value="'.$row['FirstName'].'" class="colortext"><br>
     Last Name: <br>
     <input type="text" name="LastName" value="'.$row['LastName'].'" class="colortext"><br>
     Role: <br>

     <select size="1" name="role">
     <option ';
     if ($row['Role']==1) {
       echo 'selected';
     }
     echo ' value="1">User</option>
     <option ';
     if ($row['Role']==2) {
       echo 'selected';
     }
     echo ' value="2">Admin</option>
     </select><br>

     <input type="hidden" name="someid" value="'.$row['id'].'">
     <input type="submit">
     </form>';

     echo '</div>';
     /*--------------- IMG -----------*/
     echo '<div class="prof_imgupload">';
     if ($row['Photo']=="0") {
       echo '<img class="img_userphoto" src="img_userphoto/0.png">';
     } else {
       echo '<img class="img_userphoto" src="img_userphoto/'.$row['id'].$row['Photo'].'">';
     }
     echo '<br><br><form action="file-handler.php" method="post" enctype="multipart/form-data">
        <input type="file" name="upload" accept="image/*">
        <input type="hidden" name="user_upld_id" value="'.$row['id'].'"><br><br>
        <input type="submit">
      </form>';
     echo '</div>';
     /*------------- ENDIMG -----------*/
   }
   elseif ($_SESSION['login']==$row['login']) {
     //editable
     echo '<form method="POST" action="update_profile_as_user.php">
     Login: <br>
     <input type="text" value="'.$row['login'].'" readonly><br>
     New Password: <br>
     <input type="password" name="pwd" class="colortext"><br>
     First Name: <br>
     <input type="text" name="FirstName" value="'.$row['FirstName'].'" class="colortext"><br>
     Last Name: <br>
     <input type="text" name="LastName" value="'.$row['LastName'].'" class="colortext"><br>
     Role: <br>
     <input type="text" value="';
     switch($row['Role'])
     {
       case 1:
         echo 'User';
         break;
       case 2:
         echo 'Admin';
         break;
     }
     echo '" readonly><br>
     <input type="hidden" name="someid" value="'.$row['id'].'">
     <input type="submit">
     </form>';

     echo '</div>';
     /*--------------- IMG -----------*/
     echo '<div class="prof_imgupload">';
     if ($row['Photo']=="0") {
       echo '<img class="img_userphoto" src="img_userphoto/0.png">';
     } else {
       echo '<img class="img_userphoto" src="img_userphoto/'.$row['id'].$row['Photo'].'">';
     }
     echo '<br><br><form action="file-handler.php" method="post" enctype="multipart/form-data">
        <input type="file" name="upload" accept="image/*">
        <input type="hidden" name="user_upld_id" value="'.$row['id'].'"><br><br>
        <input type="submit">
      </form>';
     echo '</div>';
     /*------------- ENDIMG -----------*/
   }
   else {
      //not editable.
     echo '<form>
     Login: <br>
     <input type="text" value="'.$row['login'].'" readonly><br>
     First Name: <br>
     <input type="text" value="'.$row['FirstName'].'" readonly><br>
     Last Name: <br>
     <input type="text" value="'.$row['LastName'].'" readonly><br>
     Role: <br>
     <input type="text" value="';
     switch($row['Role'])
     {
       case 1:
         echo 'User';
         break;
       case 2:
         echo 'Admin';
         break;
     }
     echo '" readonly><br>
     </form>
     <br> <a href="index.php">Back</a>';

     echo '</div>';
   }

 }
?>
</html>
